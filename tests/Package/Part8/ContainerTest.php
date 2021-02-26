<?php

declare(strict_types=1);

namespace Tests\Package\Part8;

use Exception;
use LogicException;
use Package\Part8\Container;
use Tests\PHPUnitTestCase;

/**
 * @see https://github.com/mutaimwiti/php-ioc-container/blob/master/tests/ContainerTest.php
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
final class ContainerTest extends PHPUnitTestCase
{
    /**
     * @implements ArrayAccess<?string, mixed>
     */
    protected Container $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new Container();
    }

    /**
     * @test
     */
    public function it_should_bind_and_resolve_arbitrary_values_correctly(): void
    {
        $abstract = Fixtures\Classes\ClassA::class;
        $concrete = Fixtures\Classes\ClassB::class;
        $this->container->bind($abstract, fn () => $concrete);

        $actual = $this->container->make($abstract);
        parent::assertSame($concrete, $actual);
    }

    /**
     * @test
     */
    public function it_should_register_and_resolve_arbitrary_values_as_instances(): void
    {
        $abstract = Fixtures\Classes\ClassA::class;
        $instance = Fixtures\Classes\ClassB::class;
        $this->container->instance($abstract, $instance);

        $actual = $this->container->make($abstract);
        parent::assertSame($instance, $actual);
    }

    /**
     * @test
     */
    public function it_should_throw_if_it_cannot_resolve_item(): void
    {
        $abstract = get_class(new class {
        });
        $actual = $this->container->make($abstract);
        parent::assertIsObject($actual);
    }

    /**
     * @test
     */
    public function it_automatically_instantiates_class_with_empty_constructor(): void
    {
        $expected = new Fixtures\Classes\ClassA();
        $actual = $this->container->make(get_class($expected));
        parent::assertTrue($expected->equals($actual));
    }

    /**
     * @test
     */
    public function it_automatically_instantiates_class_without_constructor(): void
    {
        $expected = new Fixtures\Classes\ClassH();
        $actual = $this->container->make(get_class($expected));
        parent::assertTrue($expected->equals($actual));
    }

    /**
     * @test
     */
    public function it_automatically_instantiates_class_with_class_dependencies(): void
    {
        $expected = new Fixtures\Classes\ClassB(new Fixtures\Classes\ClassA());
        $actual = $this->container->make(get_class($expected));
        parent::assertTrue($expected->equals($actual));
    }

    /**
     * @test
     */
    public function it_recursively_instantiates_class_with_any_class_dependencies(): void
    {
        $expected = new Fixtures\Classes\ClassC(
            new Fixtures\Classes\ClassA(),
            new Fixtures\Classes\ClassB(new Fixtures\Classes\ClassA())
        );
        $actual = $this->container->make(get_class($expected));
        parent::assertTrue($expected->equals($actual));
    }

    /**
     * @test
     */
    public function it_throws_for_for_primitive_types_missing_default_values(): void
    {
        parent::expectException(Exception::class);
        $this->container->make(Fixtures\Classes\ClassD::class);
    }

    /**
     * @test
     */
    public function it_uses_default_value_for_primitive_types(): void
    {
        $expected = new Fixtures\Classes\ClassE(new Fixtures\Classes\ClassA());

        $resolved = $this->container->make(Fixtures\Classes\ClassE::class);

        parent::assertSame($expected->x, $resolved->x);
    }

    /**
     * @test
     */
    public function it_allows_binding_of_closures(): void
    {
        $this->container->bind(Fixtures\Classes\ClassD::class, function (Container $container) {
            return new Fixtures\Classes\ClassD($container->make(Fixtures\Classes\ClassA::class), 7);
        });

        $expected = new Fixtures\Classes\ClassD(new Fixtures\Classes\ClassA(), 7);

        $actual = $this->container->make(Fixtures\Classes\ClassD::class);
        parent::assertTrue($expected->equals($actual));
    }

    /**
     * @test
     */
    public function it_binds_abstract_to_itself_if_no_concrete_is_provided(): void
    {
        $this->container->bind(Fixtures\Classes\ClassA::class);

        $expected = new Fixtures\Classes\ClassA();
        $actual = $this->container->make(Fixtures\Classes\ClassA::class);

        parent::assertTrue($expected->equals($actual));
    }

    /**
     * @test
     */
    public function it_throws_for_interface_without_binding(): void
    {
        parent::expectException(Exception::class);
        $this->container->make(Fixtures\Interfaces\Contract1::class);
    }

    /**
     * @test
     */
    public function it_throws_for_interface_bound_to_interface(): void
    {
        parent::expectException(Exception::class);
        $this->container->bind(Fixtures\Interfaces\Contract1::class, Fixtures\Interfaces\Contract2::class);

        $this->container->make(Fixtures\Interfaces\Contract1::class);
    }

    /**
     * @test
     */
    public function it_correctly_resolves_interface_bound_to_concrete(): void
    {
        $this->container->bind(Fixtures\Interfaces\Contract1::class, Fixtures\Classes\Class1::class);

        $actual = $this->container->make(Fixtures\Interfaces\Contract1::class);
        $expected = new Fixtures\Classes\Class1();

        parent::assertTrue($expected->equals($actual));
    }

    /**
     * @test
     */
    public function it_follows_nested_bindings_to_resolve_correct_type(): void
    {
        $this->container->bind(Fixtures\Interfaces\Contract1::class, Fixtures\Classes\Class1::class);
        $this->container->bind(Fixtures\Interfaces\Contract2::class, Fixtures\Interfaces\Contract1::class);
        $this->container->bind(Fixtures\Interfaces\Contract3::class, Fixtures\Interfaces\Contract2::class);

        $actual = $this->container->make(Fixtures\Interfaces\Contract3::class);
        $expected = new Fixtures\Classes\Class1();

        parent::assertTrue($expected->equals($actual));
    }

    /**
     * @test
     */
    public function it_allows_binding_to_instances(): void
    {
        $classA = new Fixtures\Classes\ClassA();

        $this->container->instance(Fixtures\Classes\ClassA::class, $classA);

        $resolved = $this->container->make(Fixtures\Classes\ClassA::class);

        parent::assertSame(spl_object_hash($classA), spl_object_hash($resolved));
    }

    /**
     * @test
     */
    public function it_uses_bound_instances_when_loading_class_dependencies(): void
    {
        $classA = new Fixtures\Classes\ClassA();
        $classA->message = 'Hello world';

        $this->container->instance(Fixtures\Classes\ClassA::class, $classA);

        $expected = new Fixtures\Classes\ClassC($classA, new Fixtures\Classes\ClassB($classA));
        $resolved = $this->container->make(Fixtures\Classes\ClassC::class);

        parent::assertTrue($expected->classA->equals($resolved->classA));
        parent::assertTrue($expected->classB->classA->equals($resolved->classB->classA));
    }

    /**
     * @test
     */
    public function it_binds_singletons(): void
    {
        $this->container->singleton(Fixtures\Classes\ClassA::class);

        $resolved = $this->container->make(Fixtures\Classes\ClassA::class);
        $resolved2 = $this->container->make(Fixtures\Classes\ClassA::class);

        parent::assertSame(spl_object_hash($resolved), spl_object_hash($resolved2));
    }

    /**
     * @test
     */
    public function it_drops_existing_instances_when_bindings_are_registered(): void
    {
        $classA = new Fixtures\Classes\ClassA();

        $this->container->instance(Fixtures\Classes\ClassA::class, $classA);
        $this->container->bind(Fixtures\Classes\ClassA::class);

        $resolved = $this->container->make(Fixtures\Classes\ClassA::class);

        parent::assertNotSame(spl_object_hash($classA), spl_object_hash($resolved));
    }

    /**
     * @test
     */
    public function it_should_not_allow_self_aliasing(): void
    {
        parent::expectException(LogicException::class);
        $this->container->alias(Fixtures\Classes\ClassA::class, Fixtures\Classes\ClassA::class);
    }

    /**
     * @test
     */
    public function it_should_clear_all_bindings_when_flush_is_invoked(): void
    {
        parent::expectException(Exception::class);

        $this->container->bind(Fixtures\Interfaces\Contract1::class, Fixtures\Classes\Class1::class);
        $this->container->flush();
        $this->container->make(Fixtures\Interfaces\Contract1::class);
    }

    /**
     * @test
     */
    public function it_should_clear_all__registered_instances_when_flush_is_invoked(): void
    {
        parent::expectException(Exception::class);

        $this->container->instance(Fixtures\Interfaces\Contract1::class, Fixtures\Classes\Class1::class);
        $this->container->flush();
        $this->container->make(Fixtures\Interfaces\Contract1::class);
    }

    /**
     * @test
     */
    public function it_should_clear_all_resolved_instances_when_flush_is_invoked(): void
    {
        parent::expectException(Exception::class);

        $this->container->singleton(Fixtures\Interfaces\Contract1::class, Fixtures\Classes\Class1::class);
        $resolved = $this->container->make(Fixtures\Interfaces\Contract1::class);

        $this->assertInstanceOf(Fixtures\Classes\Class1::class, $resolved);

        $this->container->flush();
        $this->container->make(Fixtures\Interfaces\Contract1::class);
    }

    /**
     * @test
     */
    public function it_should_forget_a_specific_instance_when_forget_instance_is_invoked(): void
    {
        parent::expectException(Exception::class);

        $this->container->instance(Fixtures\Interfaces\Contract1::class, new Fixtures\Classes\Class1());
        $this->container->forgetInstance(Fixtures\Interfaces\Contract1::class);
        $this->container->make(Fixtures\Interfaces\Contract1::class);
    }

    /**
     * @test
     */
    public function it_should_forget_all_instances_when_forget_instances_is_invoked(): void
    {
        $this->container->instance(Fixtures\Interfaces\Contract1::class, new Fixtures\Classes\Class1());
        $this->container->instance(Fixtures\Interfaces\Contract2::class, new Fixtures\Classes\Class2());

        $this->container->forgetInstances();

        $abstracts = [
            Fixtures\Interfaces\Contract1::class,
            Fixtures\Interfaces\Contract2::class,
        ];

        foreach ($abstracts as $abstract) {
            try {
                $this->container->make($abstract);
            } catch (Exception $exception) {
                parent::assertInstanceOf(Exception::class, $exception);
            }
        }
    }

    /**
     * @test
     */
    public function it_allows_array_set_and_access(): void
    {
        // set value - bind
        $this->container[Fixtures\Interfaces\Contract1::class] = Fixtures\Classes\Class1::class;
        // access value - make
        parent::assertInstanceOf(Fixtures\Classes\Class1::class, $this->container[Fixtures\Interfaces\Contract1::class]);
    }
}
