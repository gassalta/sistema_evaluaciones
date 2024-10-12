<?php

class block
{
	var $name = "";
	var $content = "";
	var $parsed = "";
	var $vars = array();
	var $inner_block = array();
}


class template
{
	var $content;
	var $identifier_regexp = "[0-9A-Za-z_-]+";
	var $block_regexp;
	var $vars_regexp;
	var $isblock_regexp;
	var $main_block;
	var $current_block;
	var $blocks = array();
	var $theme;

	function template($theme)
	{
		if (isset($GLOBALS["path"]))
			$this->theme = str_replace($GLOBALS["path"], "", $theme);
		else
			$this->theme = $theme;
		$this->block_regexp = '@<!--\s+BEGIN\s+(' . $this->identifier_regexp . ')\s+-->(.*)<!--\s+END\s+\1\s+-->@sm';
		$this->vars_regexp = '@{\s*(' . $this->identifier_regexp . ')\s*}@sm';
		$this->isblock_regexp = '@##\s*(' . $this->identifier_regexp . ')\s*##@sm';
	}


	function load($filename)
	{
		if (file_exists($this->theme . $filename)) {
			$tplfile = $this->theme . $filename;
		} else {
			$tplfile = $GLOBALS["path"] . "templates/" . $filename;
		}
		$this->content = $this->read_file($tplfile);
		$this->blocks = $this->get_blocks($this->content);
		$this->main_block = $this->get_main_block();
	}

	function read_file($filename)
	{
		if (!($fh = @fopen($filename, "r"))) {
			return "";
		}
		$file_content = fread($fh, filesize($filename));
		fclose($fh);
		return $file_content;
	}

	function get_main_block()
	{
		$result = $this->content;
		foreach ($this->blocks as $k => $iblock) {
			$pattern = '@<!--\s+BEGIN\s+' . $iblock->name . '\s+-->(.*)<!--\s+END\s+' . $iblock->name . '\s+-->@sm';
			$result = preg_replace($pattern, "##" . $iblock->name . "##", $result);
		}
		return $result;
	}

	function get_blocks($string)
	{
		$block_array = array();
		if (preg_match_all($this->block_regexp, $string, $regs, PREG_SET_ORDER)) {
			foreach ($regs as $key => $match) {
				$wblock = new block;
				$wblock->name = $match[1];
				$wblock->content = $match[2];
				$wblock->inner_block = $this->get_blocks($wblock->content);
				foreach ($wblock->inner_block as $k => $iblock) {
					$pattern = '@<!--\s+BEGIN\s+' . $iblock->name . '\s+-->(.*)<!--\s+END\s+' . $iblock->name . '\s+-->@sm';
					$wblock->content = preg_replace($pattern, "##" . $iblock->name . "##", $wblock->content);
				}
				$wblock->vars = $this->get_variables($wblock->content);
				$block_array[$wblock->name] = $wblock;
			}
		}
		return $block_array;
	}

	function get_variables($block_content)
	{
		$vars_array = array();
		if (preg_match_all($this->vars_regexp, $block_content, $regs, PREG_SET_ORDER)) {
			foreach ($regs as $k => $match) {
				if ($match[1] == "THEME") {
					$vars_array[$match[1]] = $this->theme;
				} else {
					$vars_array[$match[1]] = "";
				}
			}
		}
		return $vars_array;
	}

	function show()
	{
		print str_replace("\n\n", "", $this->get());
	}

	function get()
	{
		$result = $this->main_block;
		if (preg_match_all($this->isblock_regexp, $result, $regs, PREG_SET_ORDER)) {
			foreach ($regs as $block_to_replace) {
				$pattern = '@##\s*(' . $block_to_replace[1] . ')\s*##@sm';
				$result = preg_replace($pattern, $this->blocks[$block_to_replace[1]]->parsed, $result);
			}
		}
		return $result;
	}

	function parse_block($string = "")
	{
		$block = $this->get_block_object($string);
		$result = $block->content;
		if (preg_match_all($this->vars_regexp, $result, $regs, PREG_SET_ORDER)) {
			foreach ($regs as $var_to_replace) {
				$pattern = '@{\s*(' . $var_to_replace[1] . ')\s*}@sm';
				$result = preg_replace($pattern, str_replace("$", "&#036;", $block->vars[$var_to_replace[1]]), $result);
			}
		}

		if (preg_match_all($this->isblock_regexp, $result, $regs, PREG_SET_ORDER)) {
			foreach ($regs as $block_to_replace) {
				$pattern = '@##\s*(' . $block_to_replace[1] . ')\s*##@sm';
				$result = preg_replace($pattern, $block->inner_block[$block_to_replace[1]]->parsed, $result);
			}
		}
		$block->parsed .= $result;
		return $result;
	}

	function set_variable($key, $value)
	{
		$this->current_block->vars[$key] = $value;
	}

	function get_block_object($string)
	{
		if ($string == "") return $this->current_block;
		$block_deep = 1;
		foreach (explode("/", $string) as $b) {
			if ($block_deep == 1) {
				$block = $this->blocks[$b];
			} else {
				$block = $block->inner_block[$b];
			}
			$block_deep++;
		}
		return $block;
	}

	function set_block($string)
	{
		$this->current_block = $this->get_block_object($string);
		$this->initialize_subblock($this->current_block);
	}

	function initialize_subblock(&$block)
	{
		if (preg_match_all($this->isblock_regexp, $block->content, $regs, PREG_SET_ORDER)) {
			foreach ($regs as $subblock) {
				$block->inner_block[$subblock[1]]->parsed = "";
				$this->initialize_subblock($subblock);
			}
		}
	}

	function set_variables_array($variables_array)
	{
		foreach ($variables_array as $key => $value) {
			$this->current_block->vars[$key] = $value;
		}
	}
}
