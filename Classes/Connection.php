<?php

class Connection
{
    public function getConnection()
    {
        return mysqli_connect("db", "root", "root", "phpbr_event");
    }
}