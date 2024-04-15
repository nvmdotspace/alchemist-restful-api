<?php
namespace Nvmcommunity\Alchemist\RestfulApi\ResourceSort;

use Nvmcommunity\Alchemist\RestfulApi\Common\Exceptions\AlchemistRestfulApiException;
use Nvmcommunity\Alchemist\RestfulApi\ResourceSort\Handlers\ResourceSort;

trait ResourceSortable
{
    /**
     * @var ResourceSort
     */
    private ResourceSort $resourceSort;

    /**
     * @param array $requestInput
     * @return void
     * @throws AlchemistRestfulApiException
     */
    private function initResourceSort(array $requestInput): void
    {
        $componentConfig = $this->adapter->componentConfigs();

        if (! isset($componentConfig[ResourceSort::class])) {
            throw new AlchemistRestfulApiException("The `ResourceSort` component is not configured!
                Here is an example of the correct configuration of componentConfigs in your Adapter (inheritance of AlchemistAdapter):

                ```
                ResourceSort::class => [
                    'request_params' => [
                        'sort_param' => 'sort',
                        'direction_param' => 'direction',
                    ]
                ],
                ```
            ", AlchemistRestfulApiException::RESOURCE_SORT_CONFIGURATION_INCORRECT);
        }

        if (! isset($componentConfig[ResourceSort::class]['request_params'])) {
            throw new AlchemistRestfulApiException("Missing `request_params` configuration for `ResourceSort` component!
                Here is an example of the correct configuration of componentConfigs in your Adapter (inheritance of AlchemistAdapter):

                ```
                ResourceSort::class => [
                    'request_params' => [
                        'sort_param' => 'sort',
                        'direction_param' => 'direction',
                    ]
                ],
                ```
            ", AlchemistRestfulApiException::RESOURCE_SORT_CONFIGURATION_INCORRECT);
        }

        if (! isset($componentConfig[ResourceSort::class]['request_params']['sort_param'])) {
            throw new AlchemistRestfulApiException("Missing `sort_param` configuration for request_params in `ResourceSort` component configuration!
                Here is an example of the correct configuration of componentConfigs in your Adapter (inheritance of AlchemistAdapter):

                ```
                ResourceSort::class => [
                    'request_params' => [
                        'sort_param' => 'sort',
                        'direction_param' => 'direction',
                    ]
                ],
                ```
            ", AlchemistRestfulApiException::RESOURCE_SORT_CONFIGURATION_INCORRECT);
        }

        if (! isset($componentConfig[ResourceSort::class]['request_params']['sort_param'])) {
            throw new AlchemistRestfulApiException("Missing `direction_param` configuration for request_params in `ResourceSort` component configuration!
                Here is an example of the correct configuration of componentConfigs in your Adapter (inheritance of AlchemistAdapter):

                ```
                ResourceSort::class => [
                    'request_params' => [
                        'sort_param' => 'sort',
                        'direction_param' => 'direction',
                    ]
                ],
                ```
            ", AlchemistRestfulApiException::RESOURCE_SORT_CONFIGURATION_INCORRECT);
        }

        $sortParam      = $componentConfig[ResourceSort::class]['request_params']['sort_param'];
        $directionParam = $componentConfig[ResourceSort::class]['request_params']['direction_param'];

        if (isset($requestInput[$sortParam]) && ! is_string($requestInput[$sortParam])) {
            throw new AlchemistRestfulApiException(printf("The `%s` request input parameter must be type of string", $sortParam));
        }

        if (isset($requestInput[$directionParam]) && ! is_string($requestInput[$directionParam])) {
            throw new AlchemistRestfulApiException(sprintf('The `%s` request input parameter must be type of string', $directionParam));
        }

        $this->resourceSort = new ResourceSort($requestInput[$sortParam] ?? '', $requestInput[$directionParam] ?? '');
    }

    /**
     * @return ResourceSort
     */
    public function resourceSort(): ResourceSort
    {
        return $this->resourceSort;
    }
}