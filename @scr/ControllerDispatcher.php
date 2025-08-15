
    /**

     * Dispatch a request to a given controller and method.

     *

     * @param  \Illuminate\Routing\Route  $route

     * @param  mixed  $controller

     * @param  string  $method

     * @return mixed

     */

    public function dispatch(Route $route, $controller, $method)

    {

        $parameters = $this->resolveClassMethodDependencies(

            $route->parametersWithoutNulls(), $controller, $method

        );

 

        if (method_exists($controller, 'callAction')) {

            return $controller->callAction($method, $parameters);

        }

 

        return $controller->{$method}(...array_values($parameters));

    }

 

    /**

     * Get the middleware for the controller instance.

     *

     * @param  \Illuminate\Routing\Controller  $controller

     * @param  string  $method

     * @return array

     */

    public function getMiddleware($controller, $method)

    {

        if (! method_exists($controller, 'getMiddleware')) {

