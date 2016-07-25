<?php
/**
 * Response
 * base response, all response objects should inherit from here
 *
 * @category   Erdiko
 * @package    Core
 * @copyright  Copyright (c) 2016, Arroyo Labs, http://www.arroyolabs.com
 * @author     John Arroyo
 */
namespace erdiko\core;

use Erdiko;

/** Response Class */
class Response
{
    /** Theme object */
    protected $_theme;
    /** Theme name */
    protected $_themeName;
    /** Theme template */
    protected $_themeTemplate = 'default';
    /** Content */
    protected $_content = null;
    /** Data */
    protected $_data = array();
    /** Meta data (html header) */
    protected $_themeData = array(
        'js' =>array(), 
        'css' => array(), 
        'meta' => array()
        );
    
    /**
     * Constructor
     *
     * @param Theme $theme - Theme Object (Container)
     */
    public function __construct($theme = null)
    {
        $this->_theme = $theme;
    }

    /**
     * Set data value
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function setDataValue($key, $value)
    {
        $this->_data[$key] = $value;
    }

    /**
     * Get data value
     *
     * @param mixed $key
     * @return mixed
     */
    public function getDataValue($key)
    {
        return empty($this->_data[$key]) ? null: $this->_data[$key];
    }

    /**
     * Set theme
     *
     * @param Theme object $theme - Theme Object (Container)
     */
    public function setTheme($theme)
    {
        $this->_theme = $theme;
    }

    /**
     * Get theme
     *
     * @return Theme
     * @todo generate a Theme object if $this->_theme is null
     */
    public function getTheme()
    {
        return $this->_theme;
    }

    /**
     * Set Meta
     * Better to use addMeta since it keeps the structure better
     *
     * @param array $metadata
     */
    public function setMeta($metadata)
    {
        $this->_themeData['meta'] = $metadata;
    }

    /**
     * Add meta data tag
     *
     * @param string $name, e.g. 'description'
     * @param string $content, e.g. 'this is a page description'
     */
    public function addMeta($name, $content)
    {
        $this->_themeData['meta'][$name] = $content;
    }

    /**
     * Get meta
     * Meta tag data
     *
     * @return array $meta
     */
    public function getMeta()
    {
        return $this->_themeData['meta'];
    }

    /**
     * Set Theme Name
     *
     * @param string $themeName
     */
    public function setThemeName($themeName)
    {
        $this->_themeName = $themeName;
    }

    /**
     * Get the theme name
     * Name pecking order: response, theme, config
     *
     * @return string $name
     */
    public function getThemeName()
    {
        if(!empty($this->_themeName))
            $name = $this->_themeName;
        elseif(!empty($this->_theme))
            $name = $this->_theme->getName();
        else
            $name = \Erdiko::getConfig()['theme']['name'];
        
        return $name;
    }

    /**
     * Set Theme Template
     *
     * @param string $tamplate
     */
    public function setThemeTemplate($template)
    {
        $this->_themeTemplate = $template;
        if ($this->getTheme() != null) {
            $this->getTheme()->setTemplate($this->_themeTemplate);
        }
    }

    /**
     * Get the theme template
     *
     * @return string $_themeTemplate
     */
    public function getThemeTemplate()
    {
        return $this->_themeTemplate;
    }

    /**
     * Set content
     *
     * @param Container $content - e.g. View or Layout Object
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Append some html content to the existing content
     *
     * @param string $content
     * @todo check to see if content is a container, if so treat accordingly
     */
    public function appendContent($content)
    {
        $this->_content .= $content;
    }
    
    /**
     * Render
     *
     * @return string
     */
    public function render()
    {
        // Render all objects to html (string)
        $content = (is_object($this->_content)) ? $this->_content->toHtml() : $this->_content;

        if ($this->_theme !== null) {
            $this->_theme->setContent($content); // rendered html (body content)
            $this->_theme->setData($this->_data); // data injected from Response/Controller
            $this->_theme->setExtraMeta($this->getMeta());
            $html = $this->_theme->toHtml();
        } elseif (!empty($this->_themeName)) {
            $this->_theme = new \erdiko\core\Theme($this->_themeName, null, $this->_themeTemplate);
            $this->_theme->setContent($content); // rendered html (body content)
            $this->_theme->setData($this->_data); // data injected from Response/Controller
            $this->_theme->setExtraMeta($this->getMeta());
            $html = $this->_theme->toHtml();
        } else {
            $html = $content;
        }

        return $html;
    }

    /**
     * Render and send data to browser then end request
     *
     * @notice USE WITH CAUTION, 
     *  This should be called at the end of processing the response
     */
    public function send()
    {
        echo $this->render();
        die();
    }
}
