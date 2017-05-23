<?php
/**
 * Name       : MW WP Form Validation Rule Hiragana
 * Description: 値がひらがな
 * Version    : 1.1.1
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : July 21, 2014
 * Modified   : April 1, 2015
 * License    : GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class MW_WP_Form_Validation_Rule_Hiragana extends MW_WP_Form_Abstract_Validation_Rule {

	/**
	 * バリデーションルール名を指定
	 * @var string
	 */
	protected $name = 'hiragana';

	/**
	 * バリデーションチェック
	 *
	 * @param string $key name属性
	 * @param array $option
	 * @return string エラーメッセージ
	 */
	public function rule( $key, array $options = array() ) {
		$value = $this->Data->get( $key );

		if ( MWF_Functions::is_empty( $value ) ) {
			return;
		}

		if ( preg_match( '/^[ぁ-ゞ 　]*?[ぁ-ゞ]+?[ぁ-ゞ 　]*?$/u', $value ) ) {
			return;
		}

		$defaults = array(
			'message' => __( 'Please enter with a Japanese Hiragana.', 'mw-wp-form' )
		);
		$options = array_merge( $defaults, $options );
		return $options['message'];
	}

	/**
	 * 設定パネルに追加
	 *
	 * @param numeric $key バリデーションルールセットの識別番号
	 * @param array $value バリデーションルールセットの内容
	 */
	public function admin( $key, $value ) {
		?>
		<label><input type="checkbox" <?php checked( $value[ $this->getName() ], 1 ); ?> name="<?php echo MWF_Config::NAME; ?>[validation][<?php echo $key; ?>][<?php echo esc_attr( $this->getName() ); ?>]" value="1" /><?php esc_html_e( 'Japanese Hiragana', 'mw-wp-form' ); ?></label>
		<?php
	}
}
