<?php

class Meow_MWAI_Query_Embed extends Meow_MWAI_Query_Base {
  
  public function __construct( $messageOrQuery = null ) {
		if ( is_a( $messageOrQuery, 'Meow_MWAI_Query_Text' ) || is_a( $messageOrQuery, 'Meow_MWAI_Query_Assistant' ) ) {
			$lastMessage = $messageOrQuery->get_message();
			if ( !empty( $lastMessage ) ) {
				$this->set_message( $lastMessage );
			}
			$this->session = $messageOrQuery->session;
			$this->scope = $messageOrQuery->scope;
			$this->apiKey = $messageOrQuery->apiKey;
			$this->botId = $messageOrQuery->botId;
			$this->envId = $messageOrQuery->envId;
		}
		else {
			parent::__construct( $messageOrQuery ? $messageOrQuery : '' );
		}

    global $mwai_core;
    $ai_embeddings_default_env = $mwai_core->get_option( 'ai_embeddings_default_env' );
		$ai_embeddings_default_model = $mwai_core->get_option( 'ai_embeddings_default_model' );
    $this->set_env_id( $ai_embeddings_default_env );
    $this->set_model( $ai_embeddings_default_model );
    $this->mode = 'embedding';
  }

	#[\ReturnTypeWillChange]
  public function jsonSerialize() {
    $json = [
      'instructions' => $this->instructions,
      'message' => $this->message,

      'context' => [
        'messages' => $this->messages
      ],

      'ai' => [
        'model' => $this->model,
      ],

      'system' => [
        'class' => get_class( $this ),
        'envId' => $this->envId,
        'mode' => $this->mode,
        'scope' => $this->scope,
        'session' => $this->session,
        'maxMessages' => $this->maxMessages,
      ]
    ];

    if ( !empty( $this->context ) ) {
      $json['context']['context'] = $this->context;
    }

    return $json;
  }
}