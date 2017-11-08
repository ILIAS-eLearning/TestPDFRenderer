<#1>
<?php
/*
 * Use to register a renderer:
 * ===========================
 *
 * require_once './Services/PDFGeneration/classes/class.ilPDFCompInstaller.php';
 *
 * $renderer = 'TestPDFRenderer';
 * $path =  'Customizing/global/plugins/Services/PDFGeneration/Renderer/DummyRenderer/classes/class.ilTestPDFRendererPlugin.php';
 * ilPDFCompInstaller::registerRenderer($renderer, $path);
 *
 * $purpose = 'PrintViewOfQuestions'; // According to name given. Call multiple times.
 * ilPDFCompInstaller::registerRendererAvailability($renderer, $service, $purpose);
 */

/*
 * Use to register a service/purpose:
 * ==================================
 *
 * require_once './Services/PDFGeneration/classes/class.ilPDFCompInstaller.php';
 *
 * ilPDFCompInstaller::registerPurpose($service,$purpose,$preferred);
 * or uninstall one:
 * ilPDFCompInstaller::unregisterPurpose($service, $purpose);
 * or uninstall all:
 * ilPDFCompInstaller::flushPurposes($service);
 *
 */
?>
<#2>
<?php
 require_once './Services/PDFGeneration/classes/class.ilPDFCompInstaller.php';

 $renderer = 'TestPDF';
 $path =  'Customizing/global/plugins/Services/PDFGeneration/Renderer/TestPDFRenderer/classes/class.ilTestPDFRendererPlugin.php';
 ilPDFCompInstaller::registerRenderer($renderer, $path);

 $service = 'Test';
 $purpose = 'PrintViewOfQuestions'; // According to name given. Call multiple times.
 ilPDFCompInstaller::registerRendererAvailability($renderer, $service, $purpose);
?>
<#3>
<?php
$ilDB->manipulate("DELETE FROM pdfgen_renderer WHERE renderer = ".$ilDB->quote('TestPDFRenderer', "txt"));
$ilDB->manipulate("DELETE FROM pdfgen_renderer_avail WHERE renderer = ".$ilDB->quote('TestPDFRenderer', "txt"));
$ilDB->manipulate("DELETE FROM pdfgen_conf WHERE renderer = ".$ilDB->quote('TestPDFRenderer', "txt"));
?>
