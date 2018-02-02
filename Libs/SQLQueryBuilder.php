<?php
/**
 * File: sqlquerybuilder.class.php
 * Project: SQLQueryBuilder
 * File Created: Tuesday, 19th December 2017 3:20:01 pm
 * @author ramon1611
 * -----
 * Last Modified: Friday, 2nd February 2018 10:40:37 am
 * Modified By: ramon1611
 */

/**
 * Namespace ramon1611\Libs
 */
namespace ramon1611\Libs;

/**
 * Class SQLQueryBuilder
 * 
 * @api
 * @package SQLQueryBuilder
 */
class SQLQueryBuilder {
    /**
     * @var array Constat for selecting all columns of a table
     */
    const SELECT_ALL_COLUMNS = ['*'];

    /**
     * Constructor
     *
     * @param void 
     * @return void
     */
    public function __construct() {}
    
    
    /**
     * Generates a select statement
     *
     * @param string $table The table to select
     * @param array $columns The columns to select. Default is SQLQueryBuilder::SELECT_ALL_COLUMNS
     * @param bool $end Determines if the statement is terminated. Default value is TRUE
     * @param bool $distinct Determines if the DISTINCT statement is used. Default is FALSE
     * @return mixed Returns the generated statement or FALSE on error
     */
    public function Select( string $table, array $columns = self::SELECT_ALL_COLUMNS, bool $end = true, bool $distinct = false ) {
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
     * Generates a where statement
     *
     * @param string $condition The condition string of the WHERE statement
     * @param bool $end Determines if the statement is terminated. Default value is TRUE
     * @return mixed Returns the generated statement or FALSE on error
     */
    public function Where( string $condition, bool $end = true ) {
        if ( isset( $condition, $end ) ) {
            $query = 'WHERE '.$condition.( $end ? ';' : '' );
            return $query;
        } else
            return false;
    }

    /**
     * Generates a order statement
     *
     * @param array $columns Columns to sort by
     * @param string $order Determines in which order the results are sorted. Default is 'ASC'
     * @param bool $end Determines if the statement is terminated. Default value is TRUE
     * @return mixed Returns the generated statement or FALSE on error
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
     * Generates a insert statement
     *
     * @param string $table Table to insert
     * @param array $columns Columns into which the values are inserted
     * @param array $values Values to be inserted
     * @param bool $end Determines if the statement is terminated. Default value is TRUE
     * @return mixed Returns the generated statement or FALSE on error
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
     * Generates a update statement
     *
     * @param string $table Table to update
     * @param array $valuePairs An array with pairs of columns and values
     * @param string $condition The condition string. If empty, all entries are updated
     * @param bool $end Determines if the statement is terminated. Default value is TRUE
     * @return mixed Returns the generated statement or FALSE on error
     */
    public function Update( string $table, array $valuePairs, string $condition, bool $end = true ) {
        if ( isset( $table, $valuePairs, $end ) ) {
            $lastPair = $this->array_pop_assoc( $valuePairs );
            $valPairs = NULL;

            foreach ($valuePairs as $column => $value)
                $valPairs .= $column.'=\''.$value.'\', ';
            $valPairs .= key($lastPair).'=\''.current($lastPair).'\' ';

            $query = 'UPDATE '.$table.' SET '.$valPairs.( !empty( $condition ) ) ? $this->where( $condition, $end ) : ( $end ) ? ';' : '';
            return $query;
        } else
            return false;
    }

    /**
     * Generates a delete statement
     *
     * @param string $table Table to delete entries
     * @param string $condition The condition string
     * @param bool $end Determines if the statement is terminated. Default value is TRUE
     * @return mixed Returns the generated statement or FALSE on error
     */
    public function Delete( string $table, string $condition, bool $end = true ) {
        if ( isset( $table, $condition, $end ) ) {
            $query = 'DELETE FROM '.$table.' '.$this->where( $condition, $end );
            return $query;
        } else
            return false;
    }


    /**
     * Removes the last element of an associative array
     * 
     * @internal
     * @param array &$arr: The associative array to get the value from
     * @return mixed Returns the removed element as [ $key => $value ]
     */
    private function array_pop_assoc( array &$arr ): array {
        $value = end($arr);
        $key = key($arr);
        unset($arr[$key]);

        return [ $key => $value ];
    }
}
?>
