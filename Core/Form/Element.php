<?php

namespace Core\Form;

class Element
{
    private $type;
    private $name;
    private $options;
    private $value;

    private $class;
    private $buttonType;
    private $onClick;
    private $label;
    private $required;

    public function __construct()
    {
    }

    public function __get(string $name)
    {
        if (property_exists('Element', $name)) {
            return $this->$name;
        }
    }

    public function createElement(
        string $type,
        string $name,
        array $params,
        $value = null
    ) : void
    {
        $this->setType($type);
        $this->setName($name);
        $this->setParams($params);
        $this->setValue($value);
    }

    public function setType(string $type) : void
    {
        $this->type = $type;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function setValue($value) : void
    {
        $this->value = $value;
    }

    public function setParams(array $params) : void
    {
        foreach ($params as $key => $param) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method) && !empty($param)) {
                $this->$method($param);
            }
        }
    }

    public function setOptions(array $options) : void
    {
        $this->options = $options;
    }

    public function setClasses($classes) : void
    {
        if (is_array($classes)) {
            $this->class = implode(' ', $classes);
        } else {
            $this->class = $classes;
        }
    }

    public function setButtonType(string $type) : void
    {
        $this->buttonType = $type;
    }

    public function setOnClick(string $onClick) : void
    {
        $this->onClick = $onClick;
    }

    public function setLabel(string $label) : void
    {
        $this->label = $label;
    }

    public function setRequired(bool $required) : void
    {
        $this->required = $required;
    }

    public function validate(string $value) : bool
    {
        if (
            !(bool)$this->required
        ) {
            return true;
        }
        if (empty($value) || null === $value || $value === '') {
            return false;
        }
        if (
            $this->isSelect() &&
            array_key_exists('options', $this->options) &&
            array_key_exists($value, $this->options['options'])
        ) {
            return true;
        }
        return true;
    }

    public function isSelect() : bool
    {
        if ($this->type === 'select') {
            return true;
        }
        return false;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getButtonType()
    {
        return $this->buttonType;
    }

    public function getOnClick()
    {
        return $this->onClick;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getRequired() : bool
    {
        return (bool)$this->required;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getOptions()
    {
        return $this->options;
    }



}