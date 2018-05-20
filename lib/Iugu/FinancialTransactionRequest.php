<?php

class Iugu_FinancialTransactionRequest extends APIResource
{
    public static function create($attributes = [])
    {
        return self::createAPI($attributes);
    }

    public static function fetch($key)
    {
        return self::fetchAPI($key);
    }

    public function save()
    {
        return $this->saveAPI();
    }

    public function delete()
    {
        return $this->deleteAPI();
    }

    public function refresh()
    {
        return $this->refreshAPI();
    }

    public static function search($options = [])
    {
        return self::searchAPI($options);
    }

    /**
     * https://dev.iugu.com/reference#simular-antecipa%C3%A7%C3%A3o-de-receb%C3%ADveis
     *
     * @param $financialTransactionRequestIds array
     *
     * @return bool|Iugu_SearchResult
     * @internal param array $ids Iugu_FinancialTransactionRequest ids
     *
     */
    public static function advanceSimulation($financialTransactionRequestIds)
    {
        try {
            $response = self::API()->request(
                'GET',
                static::url().'/advance_simulation',
                ['transactions' => $financialTransactionRequestIds]
            );
            if (isset($response->errors)) {
                return false;
            }
            $new_object = self::createFromResponse($response);

            return $new_object;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * https://dev.iugu.com/reference#antecipar-receb%C3%ADveis
     *
     * @param $financialTransactionRequestIds array
     *
     * @return bool|Iugu_SearchResult
     *
     */
    public static function advance($financialTransactionRequestIds)
    {
        try {
            $response = self::API()->request(
                'POST',
                static::url().'/advance',
                ['transactions' => $financialTransactionRequestIds]
            );
            if (isset($response->errors)) {
                return false;
            }
            $new_object = self::createFromResponse($response);

            return $new_object;
        } catch (Exception $e) {
            return false;
        }
    }
}
