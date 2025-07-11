<?php

namespace App\PHPStan\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

/**
 * @implements Rule<FuncCall>
 */
class DisallowDdDumpRule implements Rule
{
    public function getNodeType(): string
    {
        return FuncCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (! $node instanceof FuncCall) {
            return [];
        }

        $name = $node->name instanceof Node\Name ? $node->name->toString() : null;

        if (in_array($name, ['dd', 'dump', 'var_dump'])) {
            return [
                sprintf('Usage of debug function "%s()" is not allowed.', $name)
            ];
        }

        return [];
    }
}
