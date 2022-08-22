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
    public function getPluginName() : string
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
	 * @param ilPropertyFormGUI $form
	 * @param string            $service
	 * @param string            $purpose
	 */
    public function addConfigElementsToForm(ilPropertyFormGUI $form, string $service, string $purpose) : void
	{
		global $lng;
		$input = new ilTextInputGUI($lng->txt('pdfg_renderer_testpdfrenderer_number'), 'number');
		$form->addItem($input);
	}

    /**
     * @param ilPropertyFormGUI $form
     * @param string            $service
     * @param string            $purpose
     * @param array             $config
     * @return void
     */
    public function populateConfigElementsInForm(
        ilPropertyFormGUI $form,
        string $service,
        string $purpose,
        array $config
    ) : void
	{
		$form->getItemByPostVar('number')->setValue($config['number']);
	}

    /**
     * @param ilPropertyFormGUI $form
     * @param string            $service
     * @param string            $purpose
     * @return bool
     */
    public function validateConfigInForm(ilPropertyFormGUI $form, string $service, string $purpose) : bool
	{
		if(true)
		{
			return true;
		}
	}

    /**
     * @param ilPropertyFormGUI $form
     * @param string            $service
     * @param string            $purpose
     * @return array|mixed[]
     */
    public function getConfigFromForm(ilPropertyFormGUI $form, string $service, string $purpose) : array
    {
		return array('number' => $form->getItemByPostVar('number')->getValue());
	}

    /**
     * @param string $service
     * @param string $purpose
     * @return int[]
     */
    public function getDefaultConfig(string $service, string $purpose)
	{
		return array('number' => 42);
	}

    /**
     * @param string             $service
     * @param string             $purpose
     * @param array              $config
     * @param ilPDFGenerationJob $job
     * @return void
     */
    public function generatePDF(string $service, string $purpose, array $config, ilPDFGenerationJob $job) : void
	{

	}

    protected function beforeUninstall() : bool
	{
		global $DIC;
		$ilDB = $DIC['ilDB'];

		$ilDB->manipulate("DELETE FROM pdfgen_renderer WHERE renderer = ".$ilDB->quote('TestPDF', "txt"));
		$ilDB->manipulate("DELETE FROM pdfgen_renderer_avail WHERE renderer = ".$ilDB->quote('TestPDF', "txt"));
		$ilDB->manipulate("DELETE FROM pdfgen_conf WHERE renderer = ".$ilDB->quote('TestPDF', "txt"));
		return true;
	}

    public function prepareGenerationRequest(string $service, string $purpose) : void
	{
		ilMathJax::getInstance()
				 ->init(ilMathJax::PURPOSE_PDF)
				 ->setRendering(ilMathJax::RENDER_SVG_AS_XML_EMBED);
	}

}