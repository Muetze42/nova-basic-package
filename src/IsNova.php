<?php

namespace NormanHuth\NovaBasePackage;

use Laravel\Nova\Http\Requests\NovaRequest;

trait IsNova
{
    /**
     * @var bool
     */
    protected bool $isEditing;

    /**
     * @var bool
     */
    protected bool $isFormRequest;

    /**
     * @var bool
     */
    protected bool $isAction;

    /**
     * The NovaRequest instance.
     *
     * @var NovaRequest
     */
    protected NovaRequest $request;

    /**
     * @return NovaRequest
     */
    protected function getRequest(): NovaRequest
    {
        if (!isset($this->request)) {
            $this->request = app(NovaRequest::class);
        }

        return $this->request;
    }

    /**
     * Determine if this request is a editing or action request.
     *
     * @return bool
     */
    protected function isFormRequest(): bool
    {
        if (!isset($this->isFormRequest)) {
            $this->isFormRequest = $this->isAction() || $this->isEditing();
        }

        return $this->isFormRequest;
    }

    /**
     * Determine if this request is an action request.
     *
     * @return bool
     */
    protected function isAction(): bool
    {
        if (!isset($this->isAction)) {
            $this->isAction = str_ends_with($this->getRequest()->path(), '/actions');
        }

        return $this->isAction;
    }

    /**
     * Determine if this request is a editing request.
     *
     * @return bool
     */
    protected function isEditing(): bool
    {
        if (!isset($this->isEditing)) {
            $editing = $this->getRequest()->input('editing');

            $this->isEditing = in_array($editing, ['true', true]);
        }

        return $this->isEditing;
    }
}
