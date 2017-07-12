<?php
namespace EscapeBlade\View;

trait EscapeBladeTrait {

    /**
     * Sandbox method to evaluate a template / view script in.
     *
     * @param string $viewFile Filename of the view
     * @param array $dataForView Data to include in rendered view.
     *    If empty the current View::$viewVars will be used.
     * @return string Rendered output
     */
    protected function _evaluate($viewFile, $dataForView)
    {
        $content = parent::_evaluate($viewFile, $dataForView);

        if (strpos($content, '{!') === false) {
            return $content;
        }

        $content = file_get_contents($viewFile);
        $contents = preg_split('/{!/', $content);
        $result = $contents[0];
        unset($contents[0]);
        foreach ($contents as $v) {
            $end = mb_strpos($v, '!}');
            $str = trim(mb_substr($v, 0, $end));
            $str = str_replace('!}', '', $str);
            $str = '<?= h(' . $str . ') ?>';
            $result .= $str;
        }

        extract($dataForView);
        ob_start();
        eval("?>" . $result);
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
}
