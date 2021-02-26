<?php

declare(strict_types=1);

namespace Package\Part8;

use ArrayAccess;
use Closure;
use Exception;
use LogicException;
use ReflectionClass;
use ReflectionException;
use ReflectionParameter;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 *
 * @implements ArrayAccess<?string, mixed>
 */
class Container implements ArrayAccess
{
    /**
     * @var array<string, class-string>
     */
    protected array $aliases = [];

    /**
     * @var array<string, array>
     */
    protected array $bindings = [];

    /**
     * @var array<string, object|string>
     */
    protected array $instances = [];

    /**
     * @param class-string $abstract
     * @param Closure|string|null $concrete
     * @param bool $shared
     */
    public function bind(
        string $abstract,
        $concrete = null,
        bool $shared = true
    ): void {
        if ($concrete === null) {
            $concrete = $abstract;
        }

        $this->dropExisting($abstract);

        $this->bindings[$abstract] = compact('concrete', 'shared');
    }

    /**
     * @param class-string $abstract
     * @param Closure|string|null $concrete
     */
    public function singleton(string $abstract, $concrete = null): void
    {
        $this->bind($abstract, $concrete, true);
    }

    /**
     * @param class-string $abstract
     * @param object|string $instance
     */
    public function instance(string $abstract, $instance): void
    {
        $this->instances[$abstract] = $instance;
    }

    /**
     * @param class-string $abstract
     * @param string $alias
     */
    public function alias(string $abstract, string $alias): void
    {
        if ($alias === $abstract) {
            throw new LogicException("[{$abstract}] is aliased to itself");
        }

        $this->aliases[$alias] = $abstract;
    }

    /**
     * @param class-string $abstract
     * @return bool|mixed|object
     * @throws Exception
     */
    public function make(string $abstract)
    {
        $abstract = $this->getAlias($abstract);

        // we prioritize instances. If an instance exists we return it
        if (array_key_exists($abstract, $this->instances)) {
            return $this->instances[$abstract];
        }
        // if no instance exists we try ro resolve from bindings
        if (array_key_exists($abstract, $this->bindings)) {
            return $this->build($abstract);
        }

        return $this->resolve($abstract);
    }

    /**
     * Clear all bindings, aliases, and instances from the container
     */
    public function flush(): void
    {
        $this->aliases = [];
        $this->bindings = [];
        $this->instances = [];
    }

    /**
     * Forget specific instance
     * @param class-string $abstract
     */
    public function forgetInstance(string $abstract): void
    {
        unset($this->instances[$abstract]);
    }

    /**
     * Forget all registered and resolved instances
     */
    public function forgetInstances(): void
    {
        $this->instances = [];
    }

    /**
     * Drop existing instances and aliases
     * @param class-string $abstract
     */
    protected function dropExisting(string $abstract): void
    {
        unset($this->instances[$abstract], $this->aliases[$abstract]);
    }

    /**
     * @param class-string $abstract
     * @return class-string
     */
    protected function getAlias(string $abstract): string
    {
        if (isset($this->aliases[$abstract])) {
            return $this->getAlias($this->aliases[$abstract]);
        }
        return $abstract;
    }

    /**
     * @param class-string $abstract
     * @return object|string
     * @throws Exception
     */
    protected function build(string $abstract)
    {
        $concrete = $this->getConcrete($abstract);

        if ($concrete instanceof Closure) {
            $instance = $concrete($this);
        } elseif ($abstract === $concrete) {
            // if abstract === concrete we resolve abstract
            $instance = $this->resolve($concrete);
        } else {
            // there is a possibility that this concrete aliases another concrete
            // in which case we want to follow any nests
            // elaboration: given bind(X, Y) and bind(Z, X) , resolve Z should give Y
            $instance = $this->make($concrete);
        }

        if ($this->isShared($abstract)) {
            $this->instances[$abstract] = $instance;
        }

        return $instance;
    }

    /**
     * @param class-string $abstract
     * @return mixed
     */
    protected function getConcrete(string $abstract)
    {
        return $this->bindings[$abstract]['concrete'];
    }

    /**
     * @param class-string $abstract
     * @return bool
     */
    protected function isShared(string $abstract): bool
    {
        return $this->bindings[$abstract]['shared'] === true;
    }

    /**
     * @param class-string $abstract
     * @return object
     * @throws ReflectionException
     */
    protected function resolve(string $abstract): object
    {
        $reflectionClass = new ReflectionClass($abstract);

        if ($reflectionClass->isInstantiable()) {
            $constructor = $reflectionClass->getConstructor();

            $arguments = [];

            if ($constructor !== null) {
                $parameters = $constructor->getParameters();

                foreach ($parameters as $parameter) {
                    $arguments[] = $this->resolveParameterArgument($parameter);
                }
            }

            return new $abstract(...$arguments);
        }
        throw new Exception("[{$abstract}] is not instantiable");
    }

    /**
     * @param ReflectionParameter $parameter
     * @return bool|mixed|object|string
     * @throws ReflectionException
     */
    protected function resolveParameterArgument(ReflectionParameter $parameter)
    {
        $class = $parameter->getClass();

        if ($class !== null) {
            return $this->make($class->name);
        }

        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }
        throw new Exception(
            "Parameter {$parameter->name} has no default value"
        );
    }

    /**
     * @param class-string $abstract
     * @return bool
     */
    protected function bound(string $abstract): bool
    {
        return isset($this->bindings[$abstract])
            || isset($this->instances[$abstract])
            || isset($this->aliases[$abstract]);
    }

    /**
     * @param class-string $key
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return $this->bound($key);
    }

    /**
     * @param class-string $key
     * @return bool|mixed|object|string
     * @throws Exception
     */
    public function offsetGet($key)
    {
        return $this->make($key);
    }

    /**
     * @param class-string $key
     * @param mixed $value
     */
    public function offsetSet($key, $value): void
    {
        $this->bind($key, $value);
    }

    /**
     * @param string $key
     */
    public function offsetUnset($key): void
    {
        unset($this->bindings[$key], $this->instances[$key]);
    }
}
