<div class="mock">
    <p class="mock-url" x-text="hunt.url"></p>
    <template x-for="row in hunt.rows" x-bind:key="row.id">
        <button type="button" x-bind:data-row="row.id" x-bind:class="[row.cls, isFound(row.id) && 'is-fixed']" x-on:click="guess(row.id)">
            <span x-text="isFound(row.id) ? (row.fixed?.label ?? row.label) : row.label"></span>
            <span x-show="row.value" x-text="isFound(row.id) ? (row.fixed?.value ?? row.value) : row.value"></span>
        </button>
    </template>
</div>

<div class="hunt-progress">
    <flux:badge color="emerald" size="sm"><span x-text="found.length"></span>&nbsp;of 4 found</flux:badge>
    <p class="identify-hint" role="status" x-show="hint" x-text="hint"></p>
</div>

<ul class="hunt-reports">
    <template x-for="id in found" x-bind:key="id">
        <li>
            <strong x-text="hunt.bugs[id]?.title"></strong>
            <span x-text="hunt.bugs[id]?.report"></span>
        </li>
    </template>
</ul>
