<?php

namespace App\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Hook extends BaseController
{
	public function getIndex() {
		$payload = json_encode($this->request->getVar());

		echo $payload;
	}

	public function postIndex() {
		$payload = json_encode($this->request->getVar());

		$data = json_decode($payload, true);

		$repoName = $data['repository']['name'];
		$ownerName = $data['repository']['owner']['login'];

		shell_exec(
			'export BASE_URL=' . escapeshellarg(base_url()) . '; ' .
			'php ' . escapeshellarg(FCPATH . 'index.php') . " scrape $repoName $ownerName"
		);
	}
}