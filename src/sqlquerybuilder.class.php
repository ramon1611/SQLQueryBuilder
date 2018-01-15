<?php
/**
 * File: sqlquerybuilder.class.php
 * Project: SQLQueryBuilder
 * File Created: Tuesday, 19th December 2017 3:20:01 pm
 * @author ramon1611
 * -----
 * Last Modified: Monday, 15th January 2018 2:50:01 pm
 * Modified By: ramon1611
 */

namespace ramon1611;

/**
 * Class SQLQueryBuilder
 * 
 * @api
 * @package SQLQueryBuilder
 */
class SQLQueryBuilder {
    const SELECT_ALL_COLUMNS = array( '*' );

    /**
     * __construct
     *
     * @param void 
     * @return void
     */
    public function __construct( ) {}
    
    
    /**
     * SQLQuery::Select
     *
     * @param string $table
     * @param array $columns
     * @param bool $end = true
     * @param bool $distinct = false
     * @return mixed
     */
    public function Select( string $table, array $columns, bool $end = true, bool $distinct = false ) {
        if ( isset( $table, $columns, $end, $distinct ) ) {
            $lastCol = array_pop( $columns );
            $cols = NULL;

            foreach ($columns as $column)
                $cols .= $column.', ';
            $cols .= $lastCol.' ';
            
            $query = 'SELECT '.( $distinct ? 'DISTINCT ' : '' ).$cols.'FROM '.$table.( $end ? ';' : '' );
            return $query;
        } else
            return false;
    }

    /**
     * SQLQuery::Where
     *
     * @param string $condition
     * @param bool $end = true
     * @return mixed
     */
    public function Where( string $condition, bool $end = true ) {
        if ( isset( $condition, $end ) ) {
            $query = 'WHERE '.$condition.( $end ? ';' : '' );
            return $query;
        } else
            return false;
    }

    /**
     * SQLQuery::Order
     *
     * @param array $columns
     * @param string $order = 'ASC'
     * @param bool $end = true
     * @return mixed
     */
    public function Order( array $columns, string $order = 'ASC', bool $end = true ) {
        if ( isset( $columns, $order, $end ) ) {
            $lastCol = array_pop( $columns );
            $cols = NULL;

            foreach ($columns as $column)
                $cols .= $column.', ';
            $cols .= $lastCol;
            
            $query = 'ORDER BY '.$cols.( $end ? ';' : '' );
            return $query;
        } else
            return false;
    }

    /**
     * SQLQuery::Insert
     *
     * @param string $table
     * @param array $columns
     * @param array $values
     * @param bool $end = true
     * @return mixed
     */
    public function Insert( string $table, array $columns, array $values, bool $end = true ) {
        if ( isset( $table, $columns, $values, $end ) ) {
            $lastCol = array_pop( $columns );
            $lastVal = array_pop( $values );
            $cols = NULL;
            $vals = NULL;
            
            foreach ($columns as $column)
                $cols .= $column.', ';
            $cols .= $lastCol.' ';
            
            foreach ($values as $value)
                $vals .= '\''.$value.'\', ';
            $vals .= $lastVal.' ';
            
            $query = 'INSERT INTO '.$table.' ('.$cols.') VALUES ('.$vals.')'.( $end ? ';' : '' );
            return $query;
        } else
            return false;
    }

    /**
     * SQLQuery::Update
     *
     * @param string $table
     * @param array $valuePairs
     * @param string $condition
     * @param bool $end = true
     * @return mixed
     */
    public function Update( string $table, array $valuePairs, string $condition, bool $end = true ) {
        if ( isset( $table, $valuePairs, $condition, $end ) ) {
            $lastPair = $this->array_pop_assoc( $valuePairs );
            $valPairs = NULL;

            foreach ($valuePairs as $column => $value)
                $valPairs .= $column.'=\''.$value.'\', ';
            $valPairs .= key($lastPair).'=\''.current($lastPair).'\' ';

            $query = 'UPDATE '.$table.' SET '.$valPairs.$this->where( $condition, $end );
            return $query;
        } else
            return false;
    }

    /**
     * SQLQuery::Delete
     *
     * @param string $table
     * @param string $condition
     * @param bool $end = true
     * @return mixed
     */
    public function Delete( string $table, string $condition, bool $end = true ) {
        if ( isset( $table, $condition, $end ) ) {
            $query = 'DELETE FROM '.$table.' '.$this->where( $condition, $end );
            return $query;
        } else
            return false;
    }


    /**
     * SQLQuery::array_pop_assoc
     * 
     * @internal
     * 
     * @param array &$arr
     * @return mixed
     */
    private function array_pop_assoc( array &$arr ): array {
        $value = end($arr);
        $key = key($arr);
        unset($arr[$key]);

        return array( $key => $value );
    }
}
?>
