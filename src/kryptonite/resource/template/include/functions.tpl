{gc:template name="displayErrorsForm($errors, $field)"}
    {gc:foreach var="$errors" as="$error"}
        {gc:if condition="$error['name'] == $field"}
            <span class="message error">
                {$error['message']}
            </span>
        {/gc:if}
    {/gc:foreach}
{/gc:template}