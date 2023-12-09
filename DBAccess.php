<?php
    namespace DB;
    class DBAccess{
        private const HOST_DB = "localhost";
        private const DATABASE_NAME ="vocchine";
        private const USERNAME ="vocchine";
        private const PASSWORD ="ohloh1koh8Koijei";

        private $connection;

        public function openDBConnection(){
            $this -> connection = mysqli_connect(
                self::HOST_DB,
                self::DATABASE_NAME,
                self::USERNAME,
                self::PASSWORD
            );
            //return mysqli_connect_errno()=0;
            if(mysqli_connect_errno()){ //se la connessione fallisce
                return false;  //ritorna false
            }
            else{
                return true; //altrimenti ritorna true
            }
        }

        public function getListaAlbum(){
            $query = "SELECT ID, Titolo, Copertina, idCSS FROM Album ORDER BY DataPubblicazione DESC";
            $queryResult = mysqli_query($this -> connection, $query) or die("errore in dbacces" .mysqli_error($this->connection));
            if(mysqli_num_rows($queryResult)!=0){
                $result=array();
                while($row = mysqli_fetch_assoc($queryResult)){
                    $result[]=$row;
                }
                $queryResult ->free();
                return $result;
            }else{
                return null;
            }
        }

        public function closeConnection(){
            mysqli_close($this ->connection);
        }
        
    }
?>