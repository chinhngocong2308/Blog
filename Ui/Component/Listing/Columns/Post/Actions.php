<?php

namespace AHT\Blog\Ui\Component\Listing\Columns\Post;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;

class Actions extends \Magento\Ui\Component\Listing\Columns\Column
{

    const URL_PATH_POST_EDIT = 'ahtblog/post/edit';
    const URL_PATH_POST_DELETE = 'ahtblog/post/delete';
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;
    private $escaper;

    /**
     * Actions constructor.
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['id'])) {
                    $title = $this->getEscaper()->escapeHtml($item['title']);
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_POST_EDIT,
                                [
                                    'id' => $item['id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_POST_DELETE,
                                [
                                    'id' => $item['id']
                                ]
                            ),
                            'label' => __('Remove'),
                            'confirm' => [
                                'title' => __('Delete '. $title. ' ?'),
                                'message' => __('Are you sure wan\'t to delete '. $title. ' ?')
                            ]
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
    private function getEscaper()
    {
        if (!$this->escaper) {
            $this->escaper = ObjectManager::getInstance()->get(Escaper::class);
        }
        return $this->escaper;
    }
}
