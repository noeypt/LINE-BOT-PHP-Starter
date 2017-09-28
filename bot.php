<?php
//$access_token = '4CXVlGNEsy06zKg2fuMieG/fQAHgHTX5HGG8cKMYc/EqvS4apN11fMSolMduMo5mr9IL3MucFSfYF7PNFSCmZfExOQV7UVh4wo3JAbbxERnuYcxqZjm05leotT9pYhlq9zUsRCbodePaVB5XxwaX4QdB04t89/1O/w1cDnyilFU=';
$access_token = 'VeERJ6r/1TQHAUp9VPw1go2wsbHqaiHHtmxkfHrLDN8sMSKvnEfbNP0vvynFi7Cq8Oz5ogqV8eHh48VfZTF+m3EaoZA60jeY5YrYvyQGmrGuHLFBaOM65Pcduz7iLJ/rIhj47oFdzw4AUyK3SiuwdlL1fjtlnWhWnycDBfYZCqc=';


// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
