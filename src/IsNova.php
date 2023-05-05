<?php

namespace NormanHuth\NovaBasePackage;

use Laravel\Nova\Http\Requests\NovaRequest;

trait IsNova
{
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
