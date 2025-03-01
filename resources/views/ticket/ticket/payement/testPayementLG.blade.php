


        <form action="{{ route('controller2-payment.payment-process',['provider' => 'ligdicash']) }}" method="post">
            @csrf
            <div class="w-full">

                <div class="mt-4 flex justify-between">
                    <button class="btn-primary" type="submit">Payer</button>
                </div>
            </div>
        </form>


