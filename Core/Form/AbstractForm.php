<?php

namespace Core\Form;

abstract class AbstractForm
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
     * @return AbstractForm
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
        $required = $this->getRequiredElements();

        foreach ($required as $name => $Element) {
            /** @var Element $Element */
            if (!array_key_exists($name, $values)) {
                $isValid = false;
                break;
            }
            if (!$Element->validate($values[$name])) {
                $isValid = false;
                break;
            }
        }

        /** If the form is not valid - it should retain values and display errors */
        if (!$isValid) {
            $this->populate($values);
        }

        return $isValid;
    }

    public function filterData(array $values)
    {
        $newValues = [];
        foreach($values as $name => $value) {
            if (array_key_exists($name, $this->formElements)) {
                /** @var Element $Element */
                $Element = $this->formElements[$name];
                $newValues[$name] = $Element->filterValue($value);
            } else {
                return false;
            }
        }

        return $newValues;
    }

    public function populate(array $values)
    {
        /** @var  Element $element */
        foreach($this->formElements as $element) {
            $name = $element->getName();
            if (array_key_exists($name, $values)) {
                $element->setValue($values[$name]);
            }
        }
        return $this;
    }

    public function removeElements(array $elements)
    {
        foreach($elements as $element) {
            $this->removeElement($element);
        }
    }

    public function disableElements(array $elements)
    {
        foreach($elements as $element) {
            $this->disableElement($element);
        }
    }

    public function removeElement(string $element)
    {
        if (array_key_exists($element, $this->formElements)) {
            unset($this->formElements[$element]);
        }
    }

    public function disableElement(string $element)
    {
        if (array_key_exists($element, $this->formElements)) {
            $this->formElements[$element]->setDisabled(true);
        }
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
     * @return array
     */
    public function getRequiredElements() : array
    {
        $result = [];
        /** @var Element $Element */
        foreach ($this->getElements() as $Element) {
            if ($Element->getRequired()) {
                $result[$Element->getName()] = $Element;
            }
        }
        return $result;
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

    public function getClass()
    {
        return $this->class;
    }

    public function getValues()
    {
        $values = [];
        /** @var Element  $element */
        foreach ($this->formElements as $name => $element) {
            $values[$name] = $element->getValue();
        }

        return $values;
    }
}
