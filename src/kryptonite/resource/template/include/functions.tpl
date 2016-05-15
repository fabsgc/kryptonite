{gc:template name="displayErrorsForm($errors, $field)"}
    {gc:if condition="(isset($errors[$field]))"}
    	{gc:foreach var="$errors[$field]" as="$error"}
    		<span class="message error">
    		    {$error['message']}
    		</span>
    	{/gc:foreach}
    {/gc:if}
{/gc:template}