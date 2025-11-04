<?php
declare(strict_types=1);

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use TYPO3\CMS\Backend\View\BackendViewFactory;
use TYPO3\CMS\Dashboard\Widgets\BarChartWidget;

return function (ContainerConfigurator $configurator, ContainerBuilder $containerBuilder) {
    if ($containerBuilder->hasDefinition(BarChartWidget::class)) {
        $services = $configurator->services();

        $configuration = $services->set('dashboard.widget.fixpunktLogStatus')
            ->class(BarChartWidget::class)
            ->tag(
                'dashboard.widget',
                [
                    'identifier' => 'fixpunktLogStatus',
                    'groupNames' => 'fixpunkt',
                    'title' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_be.xlf:dashboard.widget.fixpunktLogStatus.title',
                    'description' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_be.xlf:dashboard.widget.fixpunktLogStatus.description',
                    'iconIdentifier' => 'content-widget-chart-bar',
                    'height' => 'medium',
                    'width' => 'medium'
                ]
            )
            ->arg('$dataProvider', new Reference(\Fixpunkt\FpNewsletter\Widgets\Provider\StatusDataProvider::class));
            // TYPO3 12
            $configuration->arg('$backendViewFactory', new Reference(BackendViewFactory::class));
    }
};
