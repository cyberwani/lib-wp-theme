<?php
/**
 * Theme Scaffolding.
 *
 * @author team@UD
 * @version 0.2.4
 * @namespace UsabilityDynamics
 * @module Theme
 * @author potanin@UD
 */
namespace UsabilityDynamics\Theme {

  if( !class_exists( '\UsabilityDynamics\Theme\Scaffold' ) ) {

    /**
     * Scaffold Class
     *
     * @class Scaffold
     * @author potanin@UD
     */
    class Scaffold {

      /**
       * Theme ID.
       *
       * @param $id
       * @var string
       */
      public $id;

      /**
       * Theme Version.
       *
       * @param $version
       * @var string
       */
      public $version;

      /**
       * Theme Text Domain.
       *
       * @param $domain
       * @var string
       */
      public $domain;

      /**
       * Theme Settings.
       *
       * @param $settings
       * @var string
       */
      public $settings;

      /**
       * Initializes Theme.
       *
       * @param array $options
       */
      public function initialize( $options = array() ) {

        if( !$this->id ) {
          _doing_it_wrong( 'UsabilityDynamics\Theme\Scaffold::initialize', 'Theme ID not specified.' );
        }

      }

      /**
       * Create Theme Settings Instance.
       *
       * @param array $options
       */
      public function settings( $args = array() ) {

        $args = Utility::defaults( $args, array(

        ));

        Settings::test();

        $this->settings = new Settings( $args );

        die( '<pre>' . print_r( $this->settings , true ) . '</pre>' );

      }

      /**
       * Handles Special Rewrite Rules.
       *
       * @param array $options
       */
      public function rewrites( $options = array() ) {



      }

      /**
       * Define Dynamic Public Assets
       *
       * @param $options
       */
      public function dynamic( $options = array() ) {
        global $wp_rewrite, $__theme;

        $__theme = $options;

        // Serve Public Assets.
        add_action( 'template_redirect', function() {
          global $__theme;

          //die( '<pre>' . print_r( $__theme, true ) . '</pre>' );

          if( isset( $_SERVER[ 'REDIRECT_URL' ] ) && $_SERVER[ 'REDIRECT_URL' ] === '/styles/app.css' ) {
            $this->_serve_public( 'style', 'blah css' );
          }

          if( isset( $_SERVER[ 'REDIRECT_URL' ] ) && $_SERVER[ 'REDIRECT_URL' ] === '/scripts/app.js' ) {
            $this->_serve_public( 'script', 'blah js' );
          }

          if( isset( $_SERVER[ 'REDIRECT_URL' ] ) && $_SERVER[ 'REDIRECT_URL' ] === '/models/app.json' ) {
            $this->_serve_public( 'model', 'app.json' );
          }

        });

        // Modify Rewrite Rules.
        add_filter( 'option_rewrite_rules', function( $rules ) {

          $_rules[ '/scripts/{1}.js$' ] = 'index.php?dynamic=true&$matches[1]';
          $_rules[ '/styles/{1}.css$' ] = 'index.php?dynamic=true&matches[1]';
          $_rules[ '/models/{1}.json$' ] = 'index.php?dynamic=true&matches[1]';

          foreach( $rules as $key => $value ) {
            $_rules[ $key ] = $value;
          }

          //die( json_encode( $_rules ) );
          return $_rules;

        });

        //die( json_encode( get_option( 'rewrite_rules' ) ) );

      }

      /**
       * Configures API/RPC Methods.
       *
       * @param array $options
       */
      public function api( $options = array() ) {

      }

      /**
       * Declare Data Structure.
       *
       * @param array $options
       */
      public function structure( $options = array() ) {

      }

      /**
       * Configure Activation, Deactivation, Installation and Upgrade Handling.
       *
       * @param array $options
       */
      public function upgrade( $options = array() ) {

      }

      /**
       * Enables Customizer Interface for Settings.
       *
       * @param array $options
       */
      public function customizer( $options = array() ) {

      }

      /**
       * Enables Theme Support for Features.
       *
       * @param array $options
       */
      public function supports( $options = array() ) {

        foreach( (array) $options as $key => $config ) {
          add_theme_support( $key );
        }

      }

      /**
       * Configures Image Sizes.
       *
       * @param array $options
       */
      public function media( $options = array() ) {

        // add_image_size( 'hd_large', 890, 500, true );

      }

      /**
       * Set Theme Option.
       *
       * @param $key
       * @param $value
       */
      public function set( $key, $value ) {

      }

      /**
       * Get Theme Option.
       *
       * @param $key
       * @param $default
       */
      public function get( $key, $default ) {

      }

      /**
       * Serve Public Assets.
       *
       * @param string $type
       * @param string $data
       */
      private function _serve_public( $type = '', $data = '' ) {

        // Configure Data.
        $data = apply_filters( 'udx:theme:public:' . $type . ':data', $data );

        // Configure Headers.
        $headers = apply_filters( 'udx:theme:public:' . $type . 'headers', array(
            'Content-Type'    => 'application/javascript; charset=' . get_bloginfo( 'charset' ),
            'X-Frame-Options' => 'SAMEORIGIN',
            'Vary'            => 'Accept-Encoding'
          ));

        // Set Headers.
        foreach( (array) $headers as $name => $field_value ) {
          @header( "{$name}: {$field_value}" );
        }

        // WordPress will try to make it 404.
        http_response_code( 200 );

        // Output Data.
        die( $data );

      }

      /**
       * Handles Theme Activation.
       *
       */
      public function _activate() {

      }

      /**
       * Handles Theme Deactivation.
       *
       */
      public function _deactivate() {

      }

      /**
       * Handles Theme Installation.
       *
       */
      public function _install() {

      }

      /**
       * Handles Theme Upgrades.
       *
       */
      public function _upgrade() {

      }

    }

  }

}