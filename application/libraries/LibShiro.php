<?php
/**
 *  Dibuat Oleh Shiro
 */
class LibShiro
{

    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    	date_default_timezone_set('Asia/Jakarta');
    }

    public function layout_custom($content, $data = null) 
    {
    	$data['nama_aplikasi'] = 'Kasir App';
    	return $this->ci->load->view($content, $data);
    }

    // $this->libShiro->layout_admin('admin/pengguna/index', $data);
    public function layout_admin($content, $data = null)
    {
    	$layout['footer'] = $this->ci->load->view('admin/footer', $data);
    	$layout['header'] = $this->ci->load->view('admin/header', $data);
    	$layout['sidebar'] = $this->ci->load->view('admin/sidebar', $data);
    	$layout['content'] = $this->ci->load->view('admin/' . $content, $data);
    	return $this->ci->load->view('admin/page', $layout);
    }
}
