<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('BASE_PATH', realpath(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/..') . '/');

// require_once BASE_PATH . 'app/libs/Image.php';

class Uploader extends CI_Controller {

	/* Constructor */

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('jbimages','language'));
		$this->load->library('Image');

		// is_allowed is a helper function which is supposed to return False if upload operation is forbidden
		// [See jbimages/is_alllowed.php]

		if (is_allowed() === FALSE)
		{
			exit;
		}

		// User configured settings
		$this->config->load('uploader_settings', TRUE);
	}

	/* Language set */

	private function _lang_set($lang)
	{
		// We accept any language set as lang_id in **_dlg.js
		// Therefore an error will occur if language file doesn't exist

		$this->config->set_item('language', $lang);
		$this->lang->load('jbstrings', $lang);
	}

	/* Default upload routine */

	public function upload ($lang='english')
	{

		// Set language
		$this->_lang_set($lang);

		// Get configuartion data (we fill up 2 arrays - $config and $conf)

		$conf['img_path']			= $this->config->item('img_path',		'uploader_settings');
		$conf['allow_resize']		= $this->config->item('allow_resize',	'uploader_settings');

		$config['allowed_types']	= $this->config->item('allowed_types',	'uploader_settings');
		$config['max_size']			= $this->config->item('max_size',		'uploader_settings');
		$config['encrypt_name']		= $this->config->item('encrypt_name',	'uploader_settings');
		$config['overwrite']		= $this->config->item('overwrite',		'uploader_settings');
		$config['upload_path']		= $this->config->item('upload_path',	'uploader_settings');

		if (!$conf['allow_resize'])
		{
			$config['max_width']	= $this->config->item('max_width',		'uploader_settings');
			$config['max_height']	= $this->config->item('max_height',		'uploader_settings');
		}
		else
		{
			$conf['max_width']		= $this->config->item('max_width',		'uploader_settings');
			$conf['max_height']		= $this->config->item('max_height',		'uploader_settings');

			if ($conf['max_width'] == 0 and $conf['max_height'] == 0)
			{
				$conf['allow_resize'] = FALSE;
			}
		}

		// Load uploader
		$this->load->library('upload', $config);

		// Cong custom upload
		$image = new Image();

		$resultUpload = $image->uploadMulti('userfile', $config['upload_path'] . '/', array(), 'no-resize');
		// $resultUpload = array();
		// print_r($resultUpload);die;
		$result = ['result' => array()];
		foreach($resultUpload['file_name'] as $file_name => $f) {

			if($file_name != '') {
				$result['result'][] = [
					'result'     => 'file_uploaded',
					'resultcode' => 'ok',
					'filename'  => $conf['img_path'] . '/' . $file_name
				];
			}
			else{
				$result['result'][] = [
					'result'     => '',
					'resultcode' => 'failed',
					'filename'  => ''
				];
			}
		}

		// Output to user
		$this->load->view('ajax_upload_result', $result);

	}

	/* Blank Page (default source for iframe) */

	public function blank($lang='english')
	{
		$this->_lang_set($lang);
		$this->load->view('blank');
	}

	public function index($lang='english')
	{
		$this->blank($lang);
	}
}

/* End of file uploader.php */
/* Location: ./application/controllers/uploader.php */
