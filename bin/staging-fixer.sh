#!/bin/bash

PHPCBF_BIN=./vendor/bin/phpcbf
PHPCS_CODING_STANDARD=./phpcs.xml

PHP_CS_FIXER_BIN=./vendor/bin/php-cs-fixer
PHP_CS_FIXER_RULES=.php_cs

# stolen from template file
if git rev-parse --verify HEAD
then
    against=HEAD
else
    # Initial commit: diff against an empty tree object
    # @todo: ここあとで調べて適切なハッシュを入れる
    against=4b825dc642cb6eb9a060e54bf8d69288fbee4904
fi

FILES=$(git diff-index --name-only --cached --diff-filter=ACMR $against -- )

if [ "$FILES" == "" ]; then
    exit 0
fi

# match files against whitelist
FILES_TO_CHECK=""
for FILE in $FILES
do
    echo "$FILE" | egrep -q "$PHPCS_FILE_PATTERN"
    RETVAL=$?
    if [ "$RETVAL" -eq "0" ]
    then
        FILES_TO_CHECK="$FILES_TO_CHECK $FILE"
    fi
done

if [ "$FILES_TO_CHECK" == "" ]; then
    exit 0
fi

# execute the code sniffer
if [ "$PHPCS_IGNORE" != "" ]; then
    IGNORE="--ignore=$PHPCS_IGNORE"
else
    IGNORE=""
fi

if [ "$PHPCS_SNIFFS" != "" ]; then
    SNIFFS="--sniffs=$PHPCS_SNIFFS"
else
    SNIFFS=""
fi

if [ "$PHPCS_ENCODING" != "" ]; then
    ENCODING="--encoding=$PHPCS_ENCODING"
else
    ENCODING=""
fi

if [ "$PHPCS_IGNORE_WARNINGS" == "1" ]; then
    IGNORE_WARNINGS="-n"
else
    IGNORE_WARNINGS=""
fi


STAGED_FILES=""
for FILE in $FILES_TO_CHECK
do
    ID=$(git diff-index --cached $against $FILE | cut -d " " -f4)

    # create staged version of file in temporary staging area with the same
    # path as the original file so that the phpcs ignore filters can be applied
    STAGED_FILES="$STAGED_FILES $FILE"

    # check php syntax error
    errors=$(php -l "$FILE" 2>&1 | grep "PHP Parse error" | sed -e "s|.tmp_staging/||")
    if [[ "$errors" ]]; then
        echo $errors
        echo -e "\nPHPファイルに文法エラーがあります。修正してください。"
        exit 1
    fi
done

echo $STAGED_FILES

echo "$PHPCBF_BIN -s $IGNORE_WARNINGS --standard=$PHPCS_CODING_STANDARD $ENCODING $IGNORE $SNIFFS $STAGED_FILES"
OUTPUT=$($PHPCBF_BIN -s $IGNORE_WARNINGS --standard=$PHPCS_CODING_STANDARD $ENCODING $IGNORE $SNIFFS $STAGED_FILES)

# stagedだけに絞ることはできない
echo "$PHP_CS_FIXER_BIN fix -vvv --path-mode=intersection --config $PHP_CS_FIXER_RULES $STAGED_FILES"
$PHP_CS_FIXER_BIN fix -vvv --path-mode=intersection --config $PHP_CS_FIXER_RULES $STAGED_FILES
