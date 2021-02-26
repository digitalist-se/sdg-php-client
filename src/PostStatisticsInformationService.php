<?php

namespace Digitalist;

use Digitalist\Library\StatisticsInformation\Endpoint\PostStatisticsInformationService as Service;

class PostStatisticsInformationService extends Service {
    public function getUri() : string
    {
        // The generated code prefixes paths with / which breaks the API-calls.
        return substr(parent::getUri(), 1);
    }

    /*
     * The generated code doesn't return anything helpful, so we override this method.
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        return [
            'status' => $status,
            'body' => $body,
        ];
    }
}
