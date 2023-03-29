import './product-item.scss';
// import './product-item.js';

import register from 'ShopUi/app/registry';
export default register(
    'product-item',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "product-item" */
            './product-item'
        ),
);
