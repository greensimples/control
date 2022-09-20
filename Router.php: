
     * @param  \Illuminate\Http\Request  $request

     * @return mixed

     */

    protected function runRouteWithinStack(Route $route, Request $request)

    {

        $shouldSkipMiddleware = $this->container->bound('middleware.disable') &&

                                $this->container->make('middleware.disable') === true;

 

        $middleware = $shouldSkipMiddleware ? [] : $this->gatherRouteMiddleware($route);

 

        return (new Pipeline($this->container))

                        ->send($request)

                        ->through($middleware)

                        ->then(function ($request) use ($route) {

                            return $this->prepareResponse(

                                $request, $route->run()

                            );

                        });

    }

 

    /**

     * Gather the middleware for the given route with resolved class names.

     *

     * @param  \Illuminate\Routing\Route  $route

     * @return array

     */

    public function gatherRouteMiddleware(Route $route)

    {

        $computedMiddleware = $route->gatherMiddleware();

 

        $excluded = collect($route->excludedMiddleware())->map(function ($name) {

