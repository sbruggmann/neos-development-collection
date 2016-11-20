<?php
namespace TYPO3\TYPO3CR\Tests\Unit\FlowQueryOperations;

/*
 * This file is part of the TYPO3.TYPO3CR package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */
use TYPO3\Eel\FlowQuery\FlowQuery;
use TYPO3\Flow\Tests\UnitTestCase;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;
use TYPO3\TYPO3CR\Eel\FlowQueryOperations\FilterOperation;

/**
 * Testcase for the FlowQuery FilterOperation
 */
class FilterOperationTest extends UnitTestCase
{
    /**
     * @test
     */
    public function filterWithIdentifierUsesNodeIdentifier()
    {
        $node1 = $this->createMock(NodeInterface::class);
        $node2 = $this->createMock(NodeInterface::class);
        $node2->expects($this->any())->method('getIdentifier')->will($this->returnValue('node-identifier-uuid'));

        $context = array($node1, $node2);
        $q = new FlowQuery($context);

        $operation = new FilterOperation();
        $operation->evaluate($q, array('#node-identifier-uuid'));

        $this->assertEquals(array($node2), $q->getContext());
    }

    /**
     * @test
     */
    public function filterWithNodeInstanceIsSupported()
    {
        $node1 = $this->createMock(NodeInterface::class);
        $node2 = $this->createMock(NodeInterface::class);

        $context = array($node1, $node2);
        $q = new FlowQuery($context);

        $operation = new FilterOperation();
        $operation->evaluate($q, array($node2));

        $this->assertEquals(array($node2), $q->getContext());
    }
}
