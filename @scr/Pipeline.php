        return $this->then(function ($passable) {

            return $passable;

        });

    }

 

    /**

     * Get the final piece of the Closure onion.

     *

     * @param  \Closure  $destination

     * @return \Closure

     */

    protected function prepareDestination(Closure $destination)

    {

        return function ($passable) use ($destination) {

            try {

                return $destination($passable);

            } catch (Throwable $e) {

                return $this->handleException($passable, $e);

            }

        };

    }

 

    /**

     * Get a Closure that represents a slice of the application onion.

     *

     * @return \Closure

     */

    protected function carry()

    {

        return function ($stack, $pipe) {

            return function ($passable) use ($stack, $pipe) {

