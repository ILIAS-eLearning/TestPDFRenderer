<?php

require_once './Services/PDFGeneration/classes/class.ilPDFRendererPlugin.php';

class ilTestPDFRendererPlugin extends ilPDFRendererPlugin
{
	/**
	 * @var string
	 */
	const CTYPE = 'Services';

	/**
	 * @var string
	 */
	const CNAME = 'PDFGeneration';

	/**
	 * @var string
	 */
	const SLOT_ID = 'renderer';

	/**
	 * @var string
	 */
	const PNAME = 'TestPDFRenderer';

	/**+
	 * @var self
	 */
	protected static $instance = null;

	/**
	 * @return string
	 */
	public function getPluginName()
	{
		return self::PNAME;
	}

	/**
	 * @return self
	 */
	public static function getInstance()
	{
		if(self::$instance instanceof self)
		{
			return self::$instance;
		}

		self::$instance = ilPluginAdmin::getPluginObject(
			self::CTYPE,
			self::CNAME,
			self::SLOT_ID,
			self::PNAME
		);

		return self::$instance;
	}

	/**
	 * from ilRendererConfig
	 *
	 * @param \ilPropertyFormGUI $form
	 * @param string             $service
	 * @param string             $purpose
	 */
	public function addConfigElementsToForm(\ilPropertyFormGUI $form, $service, $purpose)
	{
		global $lng;
		$input = new ilTextInputGUI($lng->txt('pdfg_renderer_testpdfrenderer_number'), 'number');
		$form->addItem($input);
	}

	/**
	 * from ilRendererConfig
	 *
	 * @param \ilPropertyFormGUI $form
	 * @param string             $service
	 * @param string             $purpose
	 * @param array              $config
	 */
	public function populateConfigElementsInForm(\ilPropertyFormGUI $form, $service, $purpose, $config)
	{
		$form->getItemByPostVar('number')->setValue($config['number']);
	}

	/**
	 * from ilRendererConfig
	 *
	 * @param \ilPropertyFormGUI $form
	 * @param string             $service
	 * @param string             $purpose
	 */
	public function validateConfigInForm(\ilPropertyFormGUI $form, $service, $purpose)
	{
		if(true)
		{
			return true;
		}
	}

	/**
	 * from ilRendererConfig
	 *
	 * @param \ilPropertyFormGUI $form
	 * @param string             $service
	 * @param string             $purpose
	 */
	public function getConfigFromForm(\ilPropertyFormGUI $form, $service, $purpose)
	{
		return array('number' => $form->getItemByPostVar('number')->getValue());
	}


	/**
	 * from ilRendererConfig
	 *
	 * @param string $service
	 * @param string $purpose
	 */
	public function getDefaultConfig($service, $purpose)
	{
		return array('number' => 42);
	}

	/**
	 * from ilPDFRenderer
	 *
	 * @param string              $service
	 * @param string              $purpose
	 * @param array               $config
	 * @param \ilPDFGenerationJob $job
	 */
	public function generatePDF($service, $purpose, $config, $job)
	{
		return "Works.";
	}

	protected function beforeUninstall()
	{
		global $DIC;
		$ilDB = $DIC['ilDB'];

		$ilDB->manipulate("DELETE FROM pdfgen_renderer WHERE renderer = ".$ilDB->quote('TestPDF', "txt"));
		$ilDB->manipulate("DELETE FROM pdfgen_renderer_avail WHERE renderer = ".$ilDB->quote('TestPDF', "txt"));
		$ilDB->manipulate("DELETE FROM pdfgen_conf WHERE renderer = ".$ilDB->quote('TestPDF', "txt"));
		return true;
	}
}