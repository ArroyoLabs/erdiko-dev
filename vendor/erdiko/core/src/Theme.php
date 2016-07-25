<?php
/**
 * Theme
 *
 * @category   Erdiko
 * @package    Core
 * @copyright  Copyright (c) 2016, Arroyo Labs, http://www.arroyolabs.com
 * @author     John Arroyo
 */
namespace erdiko\core;

use Erdiko;

/**
 * Theme class
 */
class Theme extends Container
{
    /** Theme root folder */
    protected $_themeRootFolder;
    /** Name */
    protected $_name = null;
    /** Context */
    protected $_context = null;
    /** Context Config (application config) */
    protected $_contextConfig = null;
    /** Theme Config */
    protected $_themeConfig = null;
    /** Content */
    protected $_content = null;
    /** Extra css array */
    protected $_extraCss = array();
    /** Extra javascript array */
    protected $_extraJs = array();
    /** Extra Meta array */
    protected $_extraMeta = array();


    /**
     * Constructor
     *
     * @param string $themeName
     * @param mixed $data
     * @param string $template , Theme Object (Contaier)
     * @param string $context, theme against a context (defaults to context in environment)
     */
    public function __construct($themeName = 'default', $data = null, 
        $template = 'default', $context = null)
    {
        $this->initiate($template, $data);
        $this->setThemeRootFolder('themes');
        $this->setName($themeName);

        // Context can only be set at instantiation (for theme stability)
        $this->_context = ($context === null) ? getenv('ERDIKO_CONTEXT') : $context;
    }

    /**
     * Get context config
     * This is the application config for the given context (e.g. default site)
     * Context is determined by environment variable ERDIKO_CONTEXT, getenv('ERDIKO_CONTEXT')
     *
     * @return array $config, application config
     */
    public function getContextConfig()
    {
        if (empty($this->_contextConfig))
            $this->_contextConfig = Erdiko::getConfig('application', $this->_context);
        
        return $this->_contextConfig;
    }

    /**
     * Get Theme configuration (default theme)
     *
     * @return string
     */
    public function getThemeConfig()
    {
        if (empty($this->_themeConfig)) {
            $file = $this->getThemeFolder() . 'theme.json';
            $this->_themeConfig = Erdiko::getConfigFile($file);
        }
        return $this->_themeConfig;
    }

    /**
     * Get Meta
     *
     * @return string
     */
    public function getMeta()
    {
        if (isset($this->_contextConfig['site']['meta'])) {
            return array_merge($this->_contextConfig['site']['meta'], $this->_extraMeta);
        } else {
            return $this->_extraMeta;
        }
    }

    /**
     * Add meta file to page
     *
     * @param string $name
     * @param string $content
     */
    public function addMeta($name, $content)
    {
        $this->_extraMeta[$name] = $content;
    }

    /**
     * Add meta file to page
     *
     * @param array $metadata, format: array("name" => "name", "content" => "content")
     */
    public function setExtraMeta($metadata)
    {
        $this->_extraMeta = $metadata;
    }

    /**
     *  Get page title
     *
     *  @return string $page_title
     */
    public function getPageTitle()
    {
        if (isset($this->_data['page_title'])) {
            return $this->_data['page_title'];
        } else {
            return null;
        }
    }

    /**
     * Get boby title
     *
     *  @return string $body_title
     */
    public function getBodyTitle()
    {
        if (isset($this->_data['body_title'])) {
            return $this->_data['body_title'];
        } else {
            return null;
        }
    }

    /**
     * Get array of css files to include in theme
     *
     * @return array $css
     */
    public function getCss()
    {
        if (isset($this->_themeConfig['css'])) {
            return array_merge($this->_themeConfig['css'], $this->_extraCss);
        } else {
            return $this->_extraCss;
        }
    }

    /**
     * Add css file to page
     *
     * @param string $cssFile , URL of injected css file
     */
    public function addCss($cssFile)
    {
        $this->_extraCss[] = array(
            'file' => $cssFile,
            "active" => 1
            );
    }

    /**
     * Get array of js files to include
     *
     * @return array $js
     */
    public function getJs()
    {
        if (isset($this->_themeConfig['js'])) {
            return array_merge($this->_themeConfig['js'], $this->_extraJs);
        } else {
            return $this->_extraJs;
        }
    }

    /**
     * Add js file to page
     *
     * @param string $jsFile , link to js file
     */
    public function addJs($jsFile)
    {
        $this->_extraJs[] = array(
            'file' => $jsFile,
            "active" => 1
            );
    }

     /**
     * Get Theme Root Folder
     *
     * @param string $folder
     */
    public function getThemeRootFolder()
    {
        return $this->_themeRootFolder;
    }

    /**
     * Set Theme Root Folder
     *
     * @param string $folder
     */
    public function setThemeRootFolder($folder)
    {
        $this->_themeRootFolder = $folder;
    }

    /**
     * Get the theme folder
     *
     * @return string $folder
     */
    public function getThemeFolder()
    {
        return $this->getTemplateFolderPath().$this->getThemeRootFolder().'/'.$this->getName().'/';
    }

    /**
     * Get template folder relative to the theme root
     *
     * @return string
     */
    public function getTemplateFolder()
    {
        return $this->getThemeFolder().'templates/';
    }


    /**
     * Set content
     *
     * @param Container $content , e.g. View or Layout Object???
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * Get content
     *
     * @return string $content???
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Set the theme name, the name is also the id of the theme
     *
     * @param string $name , Theme name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * Get name
     *
     * @return string - Return Theme name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Get template file populated by the config
     *
     * @usage Partial render need to be declared in theme.json
     * e.g. get header/footer
     * @param string $partial
     * @param string $context
     * @return string $html
     */
    public function getTemplateHtml($partial)
    {
        $config = $this->getThemeConfig();
        $filename = $this->getTemplateFolder().$config['templates'][$partial]['file'];
        $html = $this->getTemplateFile($filename, $this->getContextConfig());
        
        return $html;
    }

    /**
     * Output content to html
     *
     * @param string @content
     * @param string @data
     * @return string
     */
    public function toHtml()
    {
        // load the theme and context (site) configs
        $this->getContextConfig();
        $this->getThemeConfig();

        $filename = $this->getTemplateFolder().$this->getTemplate();
        $html = $this->getTemplateFile($filename, $this);
        
        return $html;
    }
}
