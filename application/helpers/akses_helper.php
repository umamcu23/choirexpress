<?php
function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('auth/login');
    } else {
        $akses = $ci->session->userdata('akses');
        $id_user = $ci->session->userdata('id_user');

        $izin = FALSE;
        // mencari nama menu
        $menu = strtolower($ci->uri->segment(1)); //url menu
        $user = $ci->db->get_where('tb_user', ['id' => $id_user])->row_array();
        if($user){
           if($menu == 'order' and $user['akses'] == 'user'){
               $izin = TRUE;
           }
    
           if ($menu == 'order' and $user['akses'] == 'admin') {
               $izin = TRUE;
           }

       }else{
            redirect('auth/blocked');
       }


       if($izin == FALSE){
            redirect('auth/blocked');
        }
    }
}
