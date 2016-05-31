<?php

/* Copyright (c) 2016 Richard Klees <richard.klees@concepts-and-training.de> Extended GPL, see docs/LICENSE */

require_once("libs/composer/vendor/autoload.php");

require_once(__DIR__."/ilIndependentTemplate.php");

use ILIAS\UI\Implementation\Template\TemplateFactory;

class ilIndependentTemplateFactory implements TemplateFactory {
	public function getTemplate($path, $purge_unfilled_vars, $purge_unused_blocks) {
		return new ilIndependentTemplate($path, $purge_unfilled_vars, $purge_unused_blocks);
	}
}

/**
 * Provides common functionality for UI tests.
 */
class ILIAS_UI_TestBase extends PHPUnit_Framework_TestCase {
	public function setUp() {
		assert_options(ASSERT_WARNING, 0);
		assert_options(ASSERT_CALLBACK, null);
	}

	public function tearDown() {
		assert_options(ASSERT_WARNING, 1);
		assert_options(ASSERT_CALLBACK, null);
	}

	public function getTemplateFactory() {
		return new ilIndependentTemplateFactory();
	}

	public function getDefaultRenderer() {
		$tpl_factory = $this->getTemplateFactory();
		return new \ILIAS\UI\Implementation\DefaultRenderer($tpl_factory);
	}

	public function normalizeHTML($html) {
		return trim(str_replace("\n", "", $html));
	}        
}
