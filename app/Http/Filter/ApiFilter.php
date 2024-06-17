<?php

/**
 * Api FIlter
 *
 * Please Check Implementation With Child Controller
 */
namespace App\Http\Filter;
use Illuminate\Http\Request;

class ApiFilter
{
    protected $allowedParms = [];

    protected $columnMap = [];

    protected $operatorMap = [];

    protected $mergeAndReplaceColumns = [];

    public function prepareRequest(Request $request, $query, $operator)
    {
        $preparedQuery = [];


        if ( count( $this->mergeAndReplaceColumns ) > 0 ) {
            foreach( $this->mergeAndReplaceColumns as $param => $values ) {

                foreach( $values as $key => $value ) {
                    if (strtolower( $query) === $key ) {
                        $column = $this->columnMap[$param] ?? $param;
                        $preparedQuery = [
                            $param => $this->mergeAndReplaceColumns[$column][$key]
                        ];
                        break;
                    }
                }

            }
        }

        return $preparedQuery;
    }

    public function transform(Request $request)
    {

        $eloQuery = [];

        foreach( $this->allowedParms as $parm => $operators ) {
            $query = $request->query($parm);


            if ( !isset( $query ) ) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;


            foreach( $operators as $operator ) {

                if ( isset( $query[$operator] ) ) {


                    $column = str_replace("-", ".", $column);
                    $explodedColumn = explode(".", $column);

                    $preparedQuery = $this->prepareRequest($request, $query[$operator], $operator);

                    $explodedColumnName = ( isset( $explodedColumn[1] ) ) ? $explodedColumn[1] : $explodedColumn[0];
                    $value = $preparedQuery[ $explodedColumnName ] ??  $query[$operator];

                    if ( $operator !== "like" ) {
                        $eloQuery[] = [
                            $column,
                            $this->operatorMap[$operator],
                            $value
                        ];
                    }
                    else {
                        // Query for wildcards
                        $eloQuery[] = [
                            $column,
                            $this->operatorMap[$operator],
                            '%'.$value.'%'
                        ];
                    }

                }
            }
        }

        return $eloQuery;
    }


    /**
     * Transform Query With Relations
     *
     * @param [type] $queryRelation
     * @param Request $request
     * @return void|Object
     */
    public function transformWithRelations($queryRelation, Request $request)
    {

        $queryItems = $this->transform($request);

        // Parse through Query Items
        if ( is_array($queryItems) &&  count( $queryItems ) > 0 ) {

            foreach( $queryItems as $items ) {

                if ( str_contains($items[0], ".") ) {
                    foreach( $items as $item ) {

                        $explodedQuery = explode(".", $item);

                        $table = $explodedQuery[0];
                        $columnName = $explodedQuery[1];
                        $operator = $items[1];
                        $value = $items[2];

                        // related item search
                        $queryRelation = $queryRelation
                            ->whereRelation(
                                $table,
                                $columnName,
                                $operator,
                                $value
                            );

                        break;

                    }
                }
                else {

                    $column = $items[0];
                    $operator = $items[1];
                    $value = $items[2];

                    $queryRelation = $queryRelation->where($column, $operator, $value);
                }
            }
        }

        return $queryRelation;
    }
}
