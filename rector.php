<?php

declare(strict_types=1);

use Rector\Arguments\Rector\ClassMethod\ArgumentAdderRector;
use Rector\Arguments\Rector\ClassMethod\ReplaceArgumentDefaultValueRector;
use Rector\Arguments\Rector\FuncCall\FunctionArgumentDefaultValueReplacerRector;
use Rector\Arguments\Rector\MethodCall\RemoveMethodCallParamRector;
use Rector\CodeQuality\Rector\Assign\CombinedAssignRector;
use Rector\CodeQuality\Rector\BooleanAnd\RemoveUselessIsObjectCheckRector;
use Rector\CodeQuality\Rector\BooleanAnd\SimplifyEmptyArrayCheckRector;
use Rector\CodeQuality\Rector\BooleanNot\ReplaceMultipleBooleanNotRector;
use Rector\CodeQuality\Rector\BooleanNot\SimplifyDeMorganBinaryRector;
use Rector\CodeQuality\Rector\Catch_\ThrowWithPreviousExceptionRector;
use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\CodeQuality\Rector\Class_\StaticToSelfStaticMethodCallOnFinalClassRector;
use Rector\CodeQuality\Rector\ClassConstFetch\ConvertStaticPrivateConstantToSelfRector;
use Rector\CodeQuality\Rector\ClassMethod\InlineArrayReturnAssignRector;
use Rector\CodeQuality\Rector\ClassMethod\LocallyCalledStaticMethodToNonStaticRector;
use Rector\CodeQuality\Rector\ClassMethod\OptionalParametersAfterRequiredRector;
use Rector\CodeQuality\Rector\Concat\JoinStringConcatRector;
use Rector\CodeQuality\Rector\Empty_\SimplifyEmptyCheckOnEmptyArrayRector;
use Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector;
use Rector\CodeQuality\Rector\Expression\InlineIfToExplicitIfRector;
use Rector\CodeQuality\Rector\Expression\TernaryFalseExpressionToIfRector;
use Rector\CodeQuality\Rector\For_\ForRepeatedCountToOwnVariableRector;
use Rector\CodeQuality\Rector\Foreach_\ForeachItemsAssignToEmptyArrayToAssignRector;
use Rector\CodeQuality\Rector\Foreach_\ForeachToInArrayRector;
use Rector\CodeQuality\Rector\Foreach_\SimplifyForeachToCoalescingRector;
use Rector\CodeQuality\Rector\Foreach_\UnusedForeachValueToArrayKeysRector;
use Rector\CodeQuality\Rector\FuncCall\ArrayMergeOfNonArraysToSimpleArrayRector;
use Rector\CodeQuality\Rector\FuncCall\CallUserFuncWithArrowFunctionToInlineRector;
use Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector;
use Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector;
use Rector\CodeQuality\Rector\FuncCall\InlineIsAInstanceOfRector;
use Rector\CodeQuality\Rector\FuncCall\IsAWithStringWithThirdArgumentRector;
use Rector\CodeQuality\Rector\FuncCall\RemoveSoleValueSprintfRector;
use Rector\CodeQuality\Rector\FuncCall\SetTypeToCastRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyFuncGetArgsCountRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyInArrayValuesRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyRegexPatternRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyStrposLowerRector;
use Rector\CodeQuality\Rector\FuncCall\SingleInArrayToCompareRector;
use Rector\CodeQuality\Rector\FunctionLike\SimplifyUselessVariableRector;
use Rector\CodeQuality\Rector\Identical\BooleanNotIdenticalToNotIdenticalRector;
use Rector\CodeQuality\Rector\Identical\SimplifyArraySearchRector;
use Rector\CodeQuality\Rector\Identical\SimplifyBoolIdenticalTrueRector;
use Rector\CodeQuality\Rector\Identical\SimplifyConditionsRector;
use Rector\CodeQuality\Rector\Identical\StrlenZeroToIdenticalEmptyStringRector;
use Rector\CodeQuality\Rector\If_\CombineIfRector;
use Rector\CodeQuality\Rector\If_\CompleteMissingIfElseBracketRector;
use Rector\CodeQuality\Rector\If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector;
use Rector\CodeQuality\Rector\If_\ShortenElseIfRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfElseToTernaryRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfNotNullReturnRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfNullableReturnRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector;
use Rector\CodeQuality\Rector\LogicalAnd\AndAssignsToSeparateLinesRector;
use Rector\CodeQuality\Rector\New_\NewStaticToNewSelfRector;
use Rector\CodeQuality\Rector\NotEqual\CommonNotEqualRector;
use Rector\CodeQuality\Rector\NullsafeMethodCall\CleanupUnneededNullsafeOperatorRector;
use Rector\CodeQuality\Rector\Switch_\SingularSwitchToIfRector;
use Rector\CodeQuality\Rector\Switch_\SwitchTrueToIfRector;
use Rector\CodeQuality\Rector\Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector;
use Rector\CodeQuality\Rector\Ternary\NumberCompareToMaxFuncCallRector;
use Rector\CodeQuality\Rector\Ternary\SimplifyTautologyTernaryRector;
use Rector\CodeQuality\Rector\Ternary\SwitchNegatedTernaryRector;
use Rector\CodeQuality\Rector\Ternary\TernaryEmptyArrayArrayDimFetchToCoalesceRector;
use Rector\CodeQuality\Rector\Ternary\UnnecessaryTernaryExpressionRector;
use Rector\CodingStyle\Rector\Assign\SplitDoubleAssignRector;
use Rector\CodingStyle\Rector\ClassConst\RemoveFinalFromConstRector;
use Rector\CodingStyle\Rector\ClassConst\SplitGroupedClassConstantsRector;
use Rector\CodingStyle\Rector\ClassMethod\FuncGetArgsToVariadicParamRector;
use Rector\CodingStyle\Rector\ClassMethod\MakeInheritedMethodVisibilitySameAsParentRector;
use Rector\CodingStyle\Rector\ClassMethod\NewlineBeforeNewAssignSetRector;
use Rector\CodingStyle\Rector\Encapsed\WrapEncapsedVariableInCurlyBracesRector;
use Rector\CodingStyle\Rector\FuncCall\ArraySpreadInsteadOfArrayMergeRector;
use Rector\CodingStyle\Rector\FuncCall\CallUserFuncArrayToVariadicRector;
use Rector\CodingStyle\Rector\FuncCall\CallUserFuncToMethodCallRector;
use Rector\CodingStyle\Rector\FuncCall\ConsistentImplodeRector;
use Rector\CodingStyle\Rector\FuncCall\CountArrayToEmptyArrayComparisonRector;
use Rector\CodingStyle\Rector\FuncCall\StrictArraySearchRector;
use Rector\CodingStyle\Rector\FuncCall\VersionCompareFuncCallToConstantRector;
use Rector\CodingStyle\Rector\Property\SplitGroupedPropertiesRector;
use Rector\CodingStyle\Rector\Stmt\RemoveUselessAliasInUseStatementRector;
use Rector\CodingStyle\Rector\String_\SymplifyQuoteEscapeRector;
use Rector\CodingStyle\Rector\String_\UseClassKeywordForClassNameResolutionRector;
use Rector\CodingStyle\Rector\Ternary\TernaryConditionVariableAssignmentRector;
use Rector\CodingStyle\Rector\Use_\SeparateMultiUseImportsRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\Array_\RemoveDuplicatedArrayKeyRector;
use Rector\DeadCode\Rector\Assign\RemoveDoubleAssignRector;
use Rector\DeadCode\Rector\Assign\RemoveUnusedVariableAssignRector;
use Rector\DeadCode\Rector\BooleanAnd\RemoveAndTrueRector;
use Rector\DeadCode\Rector\Cast\RecastingRemovalRector;
use Rector\DeadCode\Rector\ClassConst\RemoveUnusedPrivateClassConstantRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveEmptyClassMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveNullTagValueNodeRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedConstructorParamRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodParameterRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnExprInConstructRector;
use Rector\DeadCode\Rector\Concat\RemoveConcatAutocastRector;
use Rector\DeadCode\Rector\ConstFetch\RemovePhpVersionIdCheckRector;
use Rector\DeadCode\Rector\Expression\RemoveDeadStmtRector;
use Rector\DeadCode\Rector\Expression\SimplifyMirrorAssignRector;
use Rector\DeadCode\Rector\For_\RemoveDeadContinueRector;
use Rector\DeadCode\Rector\For_\RemoveDeadIfForeachForRector;
use Rector\DeadCode\Rector\For_\RemoveDeadLoopRector;
use Rector\DeadCode\Rector\Foreach_\RemoveUnusedForeachKeyRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveDeadReturnRector;
use Rector\DeadCode\Rector\If_\RemoveAlwaysTrueIfConditionRector;
use Rector\DeadCode\Rector\If_\RemoveDeadInstanceOfRector;
use Rector\DeadCode\Rector\If_\RemoveTypedPropertyDeadInstanceOfRector;
use Rector\DeadCode\Rector\If_\RemoveUnusedNonEmptyArrayBeforeForeachRector;
use Rector\DeadCode\Rector\If_\SimplifyIfElseWithSameContentRector;
use Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfPhpVersionRector;
use Rector\DeadCode\Rector\Node\RemoveNonExistingVarAnnotationRector;
use Rector\DeadCode\Rector\Plus\RemoveDeadZeroAndOneOperationRector;
use Rector\DeadCode\Rector\Property\RemoveUnusedPrivatePropertyRector;
use Rector\DeadCode\Rector\Property\RemoveUselessVarTagRector;
use Rector\DeadCode\Rector\PropertyProperty\RemoveNullPropertyInitializationRector;
use Rector\DeadCode\Rector\Return_\RemoveDeadConditionAboveReturnRector;
use Rector\DeadCode\Rector\StaticCall\RemoveParentCallWithoutParentRector;
use Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector;
use Rector\DeadCode\Rector\Switch_\RemoveDuplicatedCaseInSwitchRector;
use Rector\DeadCode\Rector\Ternary\TernaryToBooleanOrFalseToBooleanAndRector;
use Rector\DeadCode\Rector\TryCatch\RemoveDeadTryCatchRector;
use Rector\EarlyReturn\Rector\If_\ChangeIfElseValueAssignToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\ChangeNestedIfsToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfContinueToMultiContinueRector;
use Rector\EarlyReturn\Rector\If_\RemoveAlwaysElseRector;
use Rector\EarlyReturn\Rector\Return_\PreparedValueToEarlyReturnRector;
use Rector\EarlyReturn\Rector\Return_\ReturnBinaryOrToEarlyReturnRector;
use Rector\EarlyReturn\Rector\StmtsAwareInterface\ReturnEarlyIfVariableRector;
use Rector\Instanceof_\Rector\Ternary\FlipNegatedTernaryInstanceofRector;
use Rector\Removing\Rector\Class_\RemoveInterfacesRector;
use Rector\Removing\Rector\Class_\RemoveTraitUseRector;
use Rector\Removing\Rector\ClassMethod\ArgumentRemoverRector;
use Rector\Removing\Rector\FuncCall\RemoveFuncCallArgRector;
use Rector\Removing\Rector\FuncCall\RemoveFuncCallRector;
use Rector\TypeDeclaration\Rector\ArrowFunction\AddArrowFunctionReturnTypeRector;
use Rector\TypeDeclaration\Rector\BooleanAnd\BinaryOpNullableToInstanceofRector;
use Rector\TypeDeclaration\Rector\Class_\AddTestsVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\Class_\MergeDateTimePropertyTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\Class_\PropertyTypeFromStrictSetterGetterRector;
use Rector\TypeDeclaration\Rector\Class_\ReturnTypeFromStrictTernaryRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeBasedOnPHPUnitDataProviderRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeFromPropertyTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationBasedOnParentClassMethodRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\ClassMethod\NumericReturnTypeFromStrictScalarReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByMethodCallTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByParentCallTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnDirectArrayRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnNewRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictConstantReturnRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictFluentReturnRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNewArrayRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictParamRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedPropertyRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnUnionTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\StrictArrayParamDimFetchRector;
use Rector\TypeDeclaration\Rector\ClassMethod\StrictStringParamConcatRector;
use Rector\TypeDeclaration\Rector\Empty_\EmptyOnNullableObjectToInstanceOfRector;
use Rector\TypeDeclaration\Rector\Function_\AddFunctionVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\FunctionLike\AddParamTypeSplFixedArrayRector;
use Rector\TypeDeclaration\Rector\FunctionLike\AddReturnTypeDeclarationFromYieldsRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictSetUpRector;
use Rector\TypeDeclaration\Rector\While_\WhileNullableToInstanceofRector;
use Rector\Visibility\Rector\ClassMethod\ExplicitPublicClassMethodRector;

$customPaths = [
];

$paths = [
    __DIR__ . '/app',
];

$customTmpRules = [
    //
];

$rules = [
    ArgumentAdderRector::class,
    FunctionArgumentDefaultValueReplacerRector::class,
    RemoveMethodCallParamRector::class,
    ReplaceArgumentDefaultValueRector::class,
    AndAssignsToSeparateLinesRector::class,
    ArrayKeyExistsTernaryThenValueToCoalescingRector::class,
    ArrayMergeOfNonArraysToSimpleArrayRector::class,
    BooleanNotIdenticalToNotIdenticalRector::class,
    CallUserFuncWithArrowFunctionToInlineRector::class,
    ChangeArrayPushToArrayAssignRector::class,
    CleanupUnneededNullsafeOperatorRector::class,
    CombinedAssignRector::class,
    CombineIfRector::class,
    CommonNotEqualRector::class,
    CompactToVariablesRector::class,
    CompleteDynamicPropertiesRector::class,
    CompleteMissingIfElseBracketRector::class,
    ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class,
    ConvertStaticPrivateConstantToSelfRector::class,
    ForRepeatedCountToOwnVariableRector::class,
    ForeachItemsAssignToEmptyArrayToAssignRector::class,
    ForeachToInArrayRector::class,
    InlineArrayReturnAssignRector::class,
    InlineConstructorDefaultToPropertyRector::class,
    InlineIfToExplicitIfRector::class,
    InlineIsAInstanceOfRector::class,
    IsAWithStringWithThirdArgumentRector::class,
    JoinStringConcatRector::class,
    LocallyCalledStaticMethodToNonStaticRector::class,
    NewStaticToNewSelfRector::class,
    NumberCompareToMaxFuncCallRector::class,
    OptionalParametersAfterRequiredRector::class,
    RemoveSoleValueSprintfRector::class,
    RemoveUselessIsObjectCheckRector::class,
    ReplaceMultipleBooleanNotRector::class,
    SetTypeToCastRector::class,
    ShortenElseIfRector::class,
    SimplifyArraySearchRector::class,
    SimplifyBoolIdenticalTrueRector::class,
    SimplifyConditionsRector::class,
    SimplifyDeMorganBinaryRector::class,
    SimplifyEmptyArrayCheckRector::class,
    SimplifyEmptyCheckOnEmptyArrayRector::class,
    SimplifyForeachToCoalescingRector::class,
    SimplifyFuncGetArgsCountRector::class,
    SimplifyIfElseToTernaryRector::class,
    SimplifyIfNotNullReturnRector::class,
    SimplifyIfNullableReturnRector::class,
    SimplifyIfReturnBoolRector::class,
    SimplifyInArrayValuesRector::class,
    SimplifyRegexPatternRector::class,
    SimplifyStrposLowerRector::class,
    SimplifyTautologyTernaryRector::class,
    SimplifyUselessVariableRector::class,
    SingleInArrayToCompareRector::class,
    SingularSwitchToIfRector::class,
    StaticToSelfStaticMethodCallOnFinalClassRector::class,
    StrlenZeroToIdenticalEmptyStringRector::class,
    SwitchNegatedTernaryRector::class,
    SwitchTrueToIfRector::class,
    TernaryEmptyArrayArrayDimFetchToCoalesceRector::class,
    TernaryFalseExpressionToIfRector::class,
    ThrowWithPreviousExceptionRector::class,
    UnnecessaryTernaryExpressionRector::class,
    UnusedForeachValueToArrayKeysRector::class,
    UseIdenticalOverEqualWithSameTypeRector::class,
    ArraySpreadInsteadOfArrayMergeRector::class,
    CallUserFuncArrayToVariadicRector::class,
    CallUserFuncToMethodCallRector::class,
    ConsistentImplodeRector::class,
    CountArrayToEmptyArrayComparisonRector::class,
    FuncGetArgsToVariadicParamRector::class,
    MakeInheritedMethodVisibilitySameAsParentRector::class,
    NewlineBeforeNewAssignSetRector::class,
    RemoveFinalFromConstRector::class,
    RemoveUselessAliasInUseStatementRector::class,
    SeparateMultiUseImportsRector::class,
    SplitDoubleAssignRector::class,
    SplitGroupedClassConstantsRector::class,
    SplitGroupedPropertiesRector::class,
    StrictArraySearchRector::class,
    SymplifyQuoteEscapeRector::class,
    TernaryConditionVariableAssignmentRector::class,
    UseClassKeywordForClassNameResolutionRector::class,
    VersionCompareFuncCallToConstantRector::class,
    WrapEncapsedVariableInCurlyBracesRector::class,
    RecastingRemovalRector::class,
    RemoveAlwaysTrueIfConditionRector::class,
    RemoveAndTrueRector::class,
    RemoveConcatAutocastRector::class,
    RemoveDeadConditionAboveReturnRector::class,
    RemoveDeadContinueRector::class,
    RemoveDeadIfForeachForRector::class,
    RemoveDeadInstanceOfRector::class,
    RemoveDeadLoopRector::class,
    RemoveDeadReturnRector::class,
    RemoveDeadStmtRector::class,
    RemoveDeadTryCatchRector::class,
    RemoveDeadZeroAndOneOperationRector::class,
    RemoveDoubleAssignRector::class,
    RemoveDuplicatedArrayKeyRector::class,
    RemoveDuplicatedCaseInSwitchRector::class,
    RemoveEmptyClassMethodRector::class,
    RemoveNonExistingVarAnnotationRector::class,
    RemoveNullPropertyInitializationRector::class,
    RemoveNullTagValueNodeRector::class,
    RemoveParentCallWithoutParentRector::class,
    RemovePhpVersionIdCheckRector::class,
    RemoveTypedPropertyDeadInstanceOfRector::class,
    RemoveUnreachableStatementRector::class,
    RemoveUnusedConstructorParamRector::class,
    RemoveUnusedForeachKeyRector::class,
    RemoveUnusedNonEmptyArrayBeforeForeachRector::class,
    RemoveUnusedPrivateClassConstantRector::class,
    RemoveUnusedPrivateMethodParameterRector::class,
    RemoveUnusedPrivateMethodRector::class,
    RemoveUnusedPrivatePropertyRector::class,
    RemoveUnusedPromotedPropertyRector::class,
    RemoveUnusedVariableAssignRector::class,
    RemoveUselessReturnExprInConstructRector::class,
    RemoveUselessVarTagRector::class,
    SimplifyIfElseWithSameContentRector::class,
    SimplifyMirrorAssignRector::class,
    TernaryToBooleanOrFalseToBooleanAndRector::class,
    UnwrapFutureCompatibleIfPhpVersionRector::class,
    ChangeIfElseValueAssignToEarlyReturnRector::class,
    ChangeNestedIfsToEarlyReturnRector::class,
    ChangeOrIfContinueToMultiContinueRector::class,
    PreparedValueToEarlyReturnRector::class,
    RemoveAlwaysElseRector::class,
    ReturnBinaryOrToEarlyReturnRector::class,
    ReturnEarlyIfVariableRector::class,
    FlipNegatedTernaryInstanceofRector::class,
    ArgumentRemoverRector::class,
    RemoveFuncCallArgRector::class,
    RemoveFuncCallRector::class,
    RemoveInterfacesRector::class,
    RemoveTraitUseRector::class,
    AddArrowFunctionReturnTypeRector::class,
    AddFunctionVoidReturnTypeWhereNoReturnRector::class,
    AddMethodCallBasedStrictParamTypeRector::class,
    AddParamTypeBasedOnPHPUnitDataProviderRector::class,
    AddParamTypeFromPropertyTypeRector::class,
    AddParamTypeSplFixedArrayRector::class,
    AddReturnTypeDeclarationBasedOnParentClassMethodRector::class,
    AddReturnTypeDeclarationFromYieldsRector::class,
    AddTestsVoidReturnTypeWhereNoReturnRector::class,
    AddVoidReturnTypeWhereNoReturnRector::class,
    BinaryOpNullableToInstanceofRector::class,
    EmptyOnNullableObjectToInstanceOfRector::class,
    MergeDateTimePropertyTypeDeclarationRector::class,
    NumericReturnTypeFromStrictScalarReturnsRector::class,
    ParamTypeByMethodCallTypeRector::class,
    ParamTypeByParentCallTypeRector::class,
    PropertyTypeFromStrictSetterGetterRector::class,
    ReturnNeverTypeRector::class,
    ReturnTypeFromReturnDirectArrayRector::class,
    ReturnTypeFromReturnNewRector::class,
    ReturnTypeFromStrictConstantReturnRector::class,
    ReturnTypeFromStrictFluentReturnRector::class,
    ReturnTypeFromStrictNativeCallRector::class,
    ReturnTypeFromStrictNewArrayRector::class,
    ReturnTypeFromStrictParamRector::class,
    ReturnTypeFromStrictTernaryRector::class,
    ReturnTypeFromStrictTypedCallRector::class,
    ReturnTypeFromStrictTypedPropertyRector::class,
    ReturnUnionTypeRector::class,
    StrictArrayParamDimFetchRector::class,
    StrictStringParamConcatRector::class,
    TypedPropertyFromStrictConstructorRector::class,
    TypedPropertyFromStrictSetUpRector::class,
    WhileNullableToInstanceofRector::class,
    ExplicitPublicClassMethodRector::class,
];

return RectorConfig::configure()
    ->withPaths($customPaths ?: $paths)
    ->withRules(rules: $customTmpRules ?: $rules);
