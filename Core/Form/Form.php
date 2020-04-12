<?php

namespace Core\Form;

class Form
{
    private $name;
    private $method;
    private $target;
    private $formElements;

    private $class;

    public function __construct()
    {
        $this->init();
        return $this;
    }

    public function init()
    {
    }

    /**
     * @param string $type
     * @param string $name
     * @param array $classes
     * @param array $params
     * @param bool $required
     * @param string $value
     * @return Form
     */
    public function addElement(
        string $type,
        string $name,
        array $params,
        $value = null
    ) : void
    {
        $element = new Element();
        $element->createElement($type, $name, $params, $value);
        $this->setElement($element);
    }

    /**
     * @param array $values
     * @return bool
     */
    public function validate(array $values) : bool
    {
        $isValid = true;
        foreach($this->formElements as $name => $element) {
            if (array_key_exists($name, $this->formElements)) {
                $isValid = $isValid && $element->validate($name, $values[$name]);
            } else {
                return false;
            }
        }
        return $isValid;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method) : void
    {
        $this->method = $method;
    }

    /**
     * @param string $target
     */
    public function setTarget(string $target) : void
    {
        $this->target = $target;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options) : void
    {
        foreach ($options as $index => $option) {
            $method = 'set' . ucfirst($index);
            if (method_exists($this, $method)) {
                $this->$method($option);
            }
        }
    }

    /**
     * @param Element $element
     */
    public function setElement(Element $element) : void
    {
        $this->formElements[$element->getName()] = $element;
    }

    public function setClasses($classes) : void
    {
        if (is_array($classes)) {
            $this->class = implode(' ', $classes);
        } else {
            $this->class = $classes;
        }
    }

    /**
     * @return array
     */
    public function getElements() : array
    {
        return $this->formElements;
    }

    /**
     * @param string $name
     * @return Element|null
     */
    public function getElementByName(string $name)
    {
        if (array_key_exists($name, $this->formElements)) {
            return $this->formElements[$name];
        }
        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getTarget() : string
    {
        return $this->target;
    }

    public function getClass() : string
    {
        return $this->class;
    }
}

