<?php
	OB_START();
 
	TRY
	{
		/* CHANGE TO YOUR CODE */
		throw new Exception('TEST');
		/* CHANGE TO YOUR CODE */
	}
	CATCH (THROWABLE $E)
	{
		OB_CLEAN();
 
		$METHOD = 'AES-256-CBC';
		$SECUREKEY = hash('sha256', 'Your very long encryption key for better effect.', TRUE);
 
		HEADER($_SERVER['SERVER_PROTOCOL'] . " 503 Service Unavailable");
		HEADER("Status: 503 Service Unavailable");
		ECHO '<!doctype><html><head><meta charset="UTF-8"><title>503 Service Unavailable</title></head><body>';
		ECHO '<h1>503 Service Unavailable</h1>';
		ECHO '<p>Sorry, something went wrong</p>';
		ECHO '<p>A team of highly trained monkeys has been dispatched to deal with this situation.</p>';
		ECHO '<p>If You see them, show them this information:</p>';
		ECHO '<p style="max-width: 500px; word-break: break-all; font-family: monospace;">';
 
		$IV = OPENSSL_RANDOM_PSEUDO_BYTES(OPENSSL_CIPHER_IV_LENGTH($METHOD));
		$ENCRYPTED = BASE64_ENCODE($IV . OPENSSL_ENCRYPT(SERIALIZE($E), $METHOD, $SECUREKEY, OPENSSL_RAW_DATA, $IV));
 
		ECHO $ENCRYPTED;
		ECHO '</p>';
		ECHO '</body></html>';
		EXIT;
	}
 
	// DECODING:
	//
	// $INPUT = 'WPROWADŹ TUTAJ KOD BŁĘDU';
	// $METHOD = 'AES-256-CBC';
	// $SECUREKEY = hash('sha256', 'Your very long encryption key for better effect.', TRUE);
	//
	// $INPUT = BASE64_DECODE($INPUT);
	// $IVSIZE = OPENSSL_CIPHER_IV_LENGTH($METHOD);
	// $IV = SUBSTR($INPUT, 0, $IVSIZE);
	// $OUTPUT = OPENSSL_DECRYPT(SUBSTR($INPUT, $IVSIZE), $METHOD, $SECUREKEY, OPENSSL_RAW_DATA, $IV);
	// ECHO $OUTPUT;
