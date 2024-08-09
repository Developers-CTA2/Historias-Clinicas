@props(['message'])
<div class="tooltip-custom">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
        <g fill="#0284c7">
            <path d="M11 10.98a1 1 0 1 1 2 0v6a1 1 0 1 1-2 0zm1-4.929a1 1 0 1 0 0 2a1 1 0 0 0 0-2" />
            <path fill-rule="evenodd"
                d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2M4 12a8 8 0 1 0 16 0a8 8 0 0 0-16 0"
                clip-rule="evenodd" />
        </g>
    </svg>
    <tool-tip role="tool-tip" class="right">
        {{ $message }}
    </tool-tip>
</div>
