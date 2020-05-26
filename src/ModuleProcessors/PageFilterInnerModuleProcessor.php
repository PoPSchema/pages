<?php

declare(strict_types=1);

namespace PoP\Pages\ModuleProcessors;

use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\ComponentModel\ModuleProcessors\AbstractModuleProcessor;

class PageFilterInnerModuleProcessor extends AbstractModuleProcessor
{
    public const MODULE_FILTERINNER_PAGES = 'filterinner-pages';

    public function getModulesToProcess(): array
    {
        return array(
            [self::class, self::MODULE_FILTERINNER_PAGES],
        );
    }

    public function getSubmodules(array $module): array
    {
        $ret = parent::getSubmodules($module);

        $inputmodules = [
            self::MODULE_FILTERINNER_PAGES => [
                // [\PoP_Module_Processor_FilterInputs::class, \PoP_Module_Processor_FilterInputs::MODULE_FILTERINPUT_SEARCH],
                // [\PoP_Module_Processor_FilterInputs::class, \PoP_Module_Processor_FilterInputs::MODULE_FILTERINPUT_ORDER],
                [\PoP_Module_Processor_FilterInputs::class, \PoP_Module_Processor_FilterInputs::MODULE_FILTERINPUT_LIMIT],
                [\PoP_Module_Processor_FilterInputs::class, \PoP_Module_Processor_FilterInputs::MODULE_FILTERINPUT_OFFSET],
                // [\PoP_Module_Processor_FilterInputs::class, \PoP_Module_Processor_FilterInputs::MODULE_FILTERINPUT_DATES],
                [\PoP_Module_Processor_FilterInputs::class, \PoP_Module_Processor_FilterInputs::MODULE_FILTERINPUT_IDS],
                [\PoP_Module_Processor_FilterInputs::class, \PoP_Module_Processor_FilterInputs::MODULE_FILTERINPUT_ID],
            ],
        ];
        if ($modules = HooksAPIFacade::getInstance()->applyFilters(
            'Pages:FilterInners:inputmodules',
            $inputmodules[$module[1]],
            $module
        )) {
            $ret = array_merge(
                $ret,
                $modules
            );
        }
        return $ret;
    }
}
