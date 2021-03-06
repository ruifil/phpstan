<?php declare(strict_types = 1);

namespace PHPStan\Type;

use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ConstantReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\TrinaryLogic;

interface Type
{

	/**
	 * @return string[]
	 */
	public function getReferencedClasses(): array;

	public function accepts(Type $type): bool;

	public function isSuperTypeOf(Type $type): TrinaryLogic;

	public function describe(VerbosityLevel $level): string;

	public function canAccessProperties(): TrinaryLogic;

	public function hasProperty(string $propertyName): bool;

	public function getProperty(string $propertyName, Scope $scope): PropertyReflection;

	public function canCallMethods(): TrinaryLogic;

	public function hasMethod(string $methodName): bool;

	public function getMethod(string $methodName, Scope $scope): MethodReflection;

	public function canAccessConstants(): TrinaryLogic;

	public function hasConstant(string $constantName): bool;

	public function getConstant(string $constantName): ConstantReflection;

	public function isIterable(): TrinaryLogic;

	public function getIterableKeyType(): Type;

	public function getIterableValueType(): Type;

	public function isOffsetAccessible(): TrinaryLogic;

	public function getOffsetValueType(Type $offsetType): Type;

	public function setOffsetValueType(?Type $offsetType, Type $valueType): Type;

	public function isCallable(): TrinaryLogic;

	/**
	 * @param \PHPStan\Analyser\Scope $scope
	 * @return \PHPStan\Reflection\ParametersAcceptor[]
	 */
	public function getCallableParametersAcceptors(Scope $scope): array;

	public function isCloneable(): TrinaryLogic;

	public function toBoolean(): BooleanType;

	public function toNumber(): Type;

	public function toInteger(): Type;

	public function toFloat(): Type;

	public function toString(): Type;

	public function toArray(): Type;

	/**
	 * @param mixed[] $properties
	 * @return self
	 */
	public static function __set_state(array $properties): self;

}
