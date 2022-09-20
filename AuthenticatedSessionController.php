


















        return view('auth.login');

    }

 

    /**

     * Handle an incoming authentication request.

     *

     * @param  \App\Http\Requests\Auth\LoginRequest  $request

     * @return \Illuminate\Http\RedirectResponse

     */

    public function store(LoginRequest $request)

    {

        $rdata = $request->all();

 

        $userData = User::where('email', $rdata['email'])->first();

       // logger("Auth Email ".$rdata['email']);

        if($userData->status == 0){

            session()->put('error', 'User Deactivated.');

            return redirect()->route('login');

        }else{

            $flag = 0;

            $secret = create secret';

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");

            curl_setopt($ch, CURLOPT_POST, 1);

            curl_setopt($ch, CURLOPT_POSTFIELDS,"secret=".$secret."&response=".$rdata['g-recaptcha-response']);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $gresult = curl_exec($ch);

            $gresponseData = json_decode($gresult , TRUE);

            curl_close ($ch);

            if($gresponseData['success'] == false){

               $flag = 3;
