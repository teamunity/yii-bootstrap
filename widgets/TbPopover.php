<?php
/**
 * TbPopover class file.
 * @author Bill Edgington <bedgington@ammsusa.com>
 * @copyright  Copyright &copy; Fest Corporation 2012-
 * @license http://none Private
 * @package bootstrap.widgets
 */

/**
 * Bootstrap popover widget.
 */
class TbPopover extends CWidget
{
    /**
     * @var boolean apply a css fade transition to the tooltip
     */
    public $animation = true;
    /**
     * @var boolean Insert html into the popover.
     *              If false, jquery's text method will be used to insert content into the dom. Use text if you're worried about XSS attacks.
     */
    public $html = false;
    /**
     * @var string|function how to position the popover - top | bottom | left | right
     */
    public $placement = 'right';
    /**
     * @var string|boolean if a selector is provided, tooltip objects will be delegated to the specified targets
     */
    public $selector = false;
    /**
     * @var string how popover is triggered - click | hover | focus | manual
     */
    public $trigger = 'click';
    /**
     * @var string|function default title value if `title` attribute isn't present (in htmlOptions)
     */
    public $title = '';
    /**
     * @var string|function default content value if `data-content` attribute isn't present (in htmlOptions)
     */
    public $content;
    /**
     * @var int|object delay showing and hiding the popover (ms) - does not apply to manual trigger type
     *                 If a number is supplied, delay is applied to both hide/show
     *                 Object structure is: delay: { show: 500, hide: 100 }
     */
    public $delay = 0;
    /*
     * @var string the tag for the element to be created and given a popover
     */
    public $tag = 'a';
    /*
     * @var string the (HTML) content of the element to be created and given a popover
     */
    public $htmlContent = '';

    /**
     * @var array the HTML attributes for the widget container.
     */
    public $htmlOptions = array();

    /**
     * Initializes the widget.
     */
    public function init()
    {
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        $id = "popover-" . uniqid();
        if (!array_key_exists("id", $this->htmlOptions) || empty($this->htmlOptions["id"])) {
            $this->htmlOptions["id"] = $id;
        }

        EBootstrap::mergeClass($this->htmlOptions, array("popoverish"));
        // if (!array_key_exists("href", $this->htmlOptions) || empty($this->htmlOptions["href"])) {
        //     $this->htmlOptions["href"] = "#";
        // }
        echo CHtml::openTag($this->tag, $this->htmlOptions);
        echo $this->htmlContent;
        echo CHtml::closeTag($this->tag);

        $popoverOptions = json_encode(array(
            "animation" => $this->animation,
            "html" => $this->html,
            "placement" => $this->placement,
            "selector" => $this->selector,
            "trigger" => $this->trigger,
            "title" => $this->title,
            "content" => $this->content,
            "delay" => $this->delay,
        ));
        $script = "<script>\$(function() {
        	\$('#$id').popover($popoverOptions);
        });</script>\n";
		echo $script;
    }
}
