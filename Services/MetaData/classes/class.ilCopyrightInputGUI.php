<?php

/* Copyright (c) 1998-2012 ILIAS open source, Extended GPL, see docs/LICENSE */

include_once("./Services/Form/classes/class.ilFormPropertyGUI.php");
include_once('Services/MetaData/classes/class.ilMDSettings.php');
include_once('Services/MetaData/classes/class.ilMDRights.php');

/**
 * This class represents a copyright property in a property form.
 *
 * @author Alex Killing <alex.killing@gmx.de>
 * @version $Id$
 * @ingroup	ServicesMetaData
 */
class ilCopyrightInputGUI extends ilFormPropertyGUI
{
    protected string $value = '';
    protected int $cols = 0;
    protected int $rows = 0;
    protected ilMDSettings $settings;
    
    /**
     * Constructor
     *
     * @param	string	$a_title	Title
     * @param	string	$a_postvar	Post Variable
     */
    public function __construct($a_title = "", $a_postvar = "")
    {
        parent::__construct($a_title, $a_postvar);
        $this->lng->loadLanguageModule("meta");
        $this->setType("copyright");
        $this->settings = ilMDSettings::_getInstance();
    }

    /**
     * Set Value.
     *
     * @param	string	$a_value	Value
     */
    public function setValue($a_value)
    {
        $this->value = $a_value;
    }

    /**
     * Get Value.
     *
     * @return	string	Value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set Cols.
     *
     * @param	int	$a_cols	Cols
     */
    public function setCols($a_cols)
    {
        $this->cols = $a_cols;
    }

    /**
     * Get Cols.
     *
     * @return	int	Cols
     */
    public function getCols()
    {
        return $this->cols;
    }

    /**
     * Set Rows.
     *
     *  @param	int	$a_rows	Rows
     */
    public function setRows($a_rows)
    {
        $this->rows = $a_rows;
    }

    /**
     * Get Rows.
     *
     * @return	int	Rows
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Set value by array
     *
     * @param	array	$a_values	value array
     */
    public function setValueByArray($a_values)
    {
        $this->setValue($a_values[$this->getPostVar()]);
    }

    /**
     * Check input, strip slashes etc. set alert, if input is not ok.
     * @return	boolean		Input ok, true/false
     */
    public function checkInput() : bool
    {
        
        if ($this->usePurifier() && $this->getPurifier()) {
            $_POST[$this->getPostVar()]["ta"] = ilUtil::stripSlashes($_POST[$this->getPostVar()]["ta"]);
        }
        
        // todo: implement setRequired, if needed

        return true;
    }

    /**
     * Insert property html
     */
    public function insert($a_tpl)
    {
        include_once('Services/MetaData/classes/class.ilMDCopyrightSelectionEntry.php');
        
        $ttpl = new ilTemplate("tpl.prop_copyright.html", true, true, "Services/MetaData");
        $entries = ilMDCopyrightSelectionEntry::_getEntries();
        $use_selection = ($this->settings->isCopyrightSelectionActive() && count($entries));
        $val = $this->getValue();
        
        if ($use_selection) {
            $default_id = ilMDCopyrightSelectionEntry::_extractEntryId($val["ta"]);
        
            include_once('Services/MetaData/classes/class.ilMDCopyrightSelectionEntry.php');
            $found = false;
            foreach ($entries as $entry) {
                $ttpl->setCurrentBlock('copyright_selection');
                
                if ($entry->getEntryId() == $default_id) {
                    $found = true;
                    $ttpl->setVariable('COPYRIGHT_CHECKED', 'checked="checked"');
                }
                $ttpl->setVariable('COPYRIGHT_ID', $entry->getEntryId());
                $ttpl->setVariable('COPYRIGHT_TITLE', $entry->getTitle());
                $ttpl->setVariable('COPYRIGHT_DESCRIPTION', $entry->getDescription());
                $ttpl->setVariable('SPOST_VAR', $this->getPostVar());
                $ttpl->parseCurrentBlock();
            }
            
            $ttpl->setCurrentBlock('copyright_selection');
            if (!$found) {
                $ttpl->setVariable('COPYRIGHT_CHECKED', 'checked="checked"');
            }
            $ttpl->setVariable('COPYRIGHT_ID', 0);
            $ttpl->setVariable('COPYRIGHT_TITLE', $this->lng->txt('meta_cp_own'));
            $ttpl->setVariable('SPOST_VAR', $this->getPostVar());
            
            $ttpl->parseCurrentBlock();
        }

        
        if ($this->getCols() > 5) {
            $ttpl->setCurrentBlock("prop_ta_c");
            $ttpl->setVariable("COLS", $this->getCols());
            $ttpl->parseCurrentBlock();
        } else {
            $ttpl->touchBlock("prop_ta_w");
        }
                
        $ttpl->setCurrentBlock("prop_copyright");
        $ttpl->setVariable("ROWS", $this->getRows());
        if (!$this->getDisabled()) {
            $ttpl->setVariable(
                "POST_VAR",
                $this->getPostVar()
            );
        }
        $ttpl->setVariable("ID", $this->getFieldId());
        if ($this->getDisabled()) {
            $ttpl->setVariable('DISABLED', 'disabled="disabled" ');
        }
        
        if ($this->getDisabled()) {
            $ttpl->setVariable(
                "HIDDEN_INPUT",
                $this->getHiddenTag($this->getPostVar(), $this->getValue())
            );
        }
        
        if (!$use_selection || !$found) {
            $ttpl->setVariable("PROPERTY_VALUE", ilUtil::prepareFormOutput($val["ta"]));
        }
        $ttpl->parseCurrentBlock();
        
        
        $a_tpl->setCurrentBlock("prop_generic");
        $a_tpl->setVariable("PROP_GENERIC", $ttpl->get());
        $a_tpl->parseCurrentBlock();
    }
}
