{gc:extends file="main"/}
<h1 class="standalone-title">
    Abonnements
    {gc:if condition="$id != null"}
        de mes élèves
    {/gc:if}
</h1>
<div class="home-start">
{gc:include file="user/home-include"/}
</div>
<div class="home-content">
    <div class="suscribe-list">
        {gc:foreach var="$offers" as="$value"}
            <div class="suscribe">
                <div class="title">
                    {$value->title}
                </div>
                <div class="interest">
                    {gc:if condition="$value->id == 1"}
                        Une offre pour débuter
                    {gc:elseif condition="$value->id == 2"/}
                        Une offre plus sérieuse
                    {gc:else/}
                        Une offre de malade !
                    {/gc:if}
                </div>
                <div class="interest">
                    {gc:if condition="$value->id == 1"}
                        Pour les indécis
                    {gc:elseif condition="$value->id == 2"/}
                        12% de réduction
                    {gc:else/}
                        18% de réduction
                    {/gc:if}
                </div>
                <div class="interest">
                    {gc:if condition="$value->id == 1"}
                        Illimité
                    {gc:elseif condition="$value->id == 2"/}
                        Illimité
                    {gc:else/}
                        Illimité
                    {/gc:if}
                </div>
                <div class="price">
                    {$value->price}€
                    <em>HT</em>
                </div>
                <div class="buy" onClick="buy({$value->id})">
                    Choisir cette formule
                </div>
                <input type="hidden" id="price-{$value->id}" value="{$value->price}"/>
            </div>
        {/gc:foreach}
    </div>
    <div class="clear"> </div>
    <div class="suscribe-buy {gc:if condition="$request->sent() == false"} hidden {/gc:if}">
        <div class="price-total">
            {{php:
                foreach($offers as $value){
                    if($value->id == $offer){
                        if($id == null){
                            echo number_format(round($value->price * 1.2, 2),2). '€ TTC';
                        }
                        else{
                            echo number_format(round($value->price * 1.2, 2),2). ' x '.$students.' = '.number_format(round($students*$value->price*1.2,2),2).'€ TTC';
                        }
                    }
                }

            }}
        </div>
        <form action="" method="post">
            <input type="hidden" name="form-suscribe" />
            <input type="hidden" name="offer" id="offer" value="{$offer}"/>
            <input type="hidden" name="students" id="students" value="{$students}" />
            <input type="text" name="bank" placeholder="Numéro de carte" class="big" required="required"/>
            <input type="text" name="expiration" placeholder="Date d'expiration" class="small" required="required"/>
            <input type="text" name="cvc" placeholder="Cryptogramme" class="small" style="float:right;" required="required"/>
            <input type="submit" value="Payer"/>
        </form>
    </div>
</div>

<script type="text/javascript">
    function buy(id){
        $('.suscribe-buy').removeClass('hidden');
        $('#offer').val(id);
        var price = $('#price-' + id).val() * 1.2;
        var students = $('#students').val();

        {gc:if condition="$id == null"}
            $('.price-total').html(price.toFixed(2) + "€ TTC");
        {gc:else/}
            var priceStudent = students * price;

            $('.price-total').html(price.toFixed(2) + " x " + students + " = " + priceStudent.toFixed(2) + "€ TTC");
        {/gc:if}

        $( document ).ready(function() {
            height();
        });
    }
</script>