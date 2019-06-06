<?php

use App\Classes\Comex\CadastraAcessoEsteiraComex;
use App\Classes\Geral\Ldap;


$usuario = new Ldap;
$acesso = new CadastraAcessoEsteiraComex($usuario);
echo $acesso;