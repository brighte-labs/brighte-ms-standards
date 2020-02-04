<?php

declare(strict_types=1);

namespace BrighteCustom\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;

//phpcs:disable SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
//phpcs:disable SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint

/**
 * InterfaceSuffixSniff
 *
 * Demands that an interface class name ends with Interface
 *
 * @package BrighteCustom
 * @author  Chris Young <chris.young@brighte.com.au>
 * @license http://spdx.org/licenses/MIT MIT License
 */
class InterfaceSuffixSniff implements \PHP_CodeSniffer\Sniffs\Sniff
{

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var string[] array
     */
    public $supportedTokenizers = ['PHP'];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return int[]
     */
    public function register(): array
    {
        return [T_INTERFACE];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $line = $tokens[$stackPtr]['line'];

        while ($tokens[$stackPtr]['line'] === $line) {
            if ($tokens[$stackPtr]['type'] === 'T_STRING') {
                if (substr($tokens[$stackPtr]['content'], -9) !== 'Interface') {
                    $phpcsFile->addError(
                        'Interface name is not suffixed with "Interface"',
                        $stackPtr,
                        'NoInterfaceSuffix',
                    );
                }
            }

            $stackPtr++;
        }
    }

}
