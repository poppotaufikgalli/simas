<?Php
    if (!isset($this->session->nip)) {
        header("location: ".base_url()."index.php/simas/login");
    }
?>