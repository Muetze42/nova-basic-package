<?php

namespace NormanHuth\NovaBasePackage;

trait HasStyle
{
    /**
     * The field's classes.
     *
     * @var array
     */
    protected array $classes = [];

    /**
     * The field's styles.
     *
     * @var array
     */
    protected array $styles = [];

    /**
     * Add classes to the field class attribute.
     *
     * @param string|array $classes
     * @return $this
     */
    public function addClasses(string|array $classes): static
    {
        $this->classes = array_merge($this->classes, (array) $classes);

        return $this;
    }

    /**
     * Set classes to the field class attribute.
     *
     * @param string|array|null $classes
     * @return $this
     */
    public function setClasses(string|array|null $classes): static
    {
        $this->classes = (array) $classes;

        return $this;
    }

    /**
     * Add styles to the field style attribute.
     *
     * @param array $styles
     * @return $this
     */
    public function addStyles(array $styles): static
    {
        $this->styles = array_merge($this->styles, $styles);

        return $this;
    }

    /**
     * Set classes to the field style attribute.
     *
     * @param string|array|null $styles
     * @return $this
     */
    public function setStyles(string|array|null $styles): static
    {
        $this->styles = (array) $styles;

        return $this;
    }
}
