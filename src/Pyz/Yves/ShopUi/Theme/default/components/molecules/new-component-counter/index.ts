import './new-component-counter.scss';

// Import the 'register' function from the Shop Application
import register from 'ShopUi/app/registry';

// Register the component
export default register(
    'new-component-counter',
    () => import(/* webpackMode: "lazy" */'./new-component-counter')
);