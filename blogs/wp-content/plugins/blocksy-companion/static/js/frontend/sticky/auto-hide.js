import { setTransparencyFor } from '../sticky'
import {
	maybeSetStickyHeightAnimated,
	getRowStickyHeight,
	computeLinearScale,
	clamp,
} from './shrink-utils'

import { shrinkHandleLogo } from './shrink-handle-logo'
import { shrinkHandleMiddleRow } from './shrink-handle-middle-row'

let cache = null

const getData = ({ stickyContainer }) => {
	if (cache) {
		return cache
	}

	let stickyContainerHeight = [
		...stickyContainer.querySelectorAll('[data-row]'),
	].reduce((res, row) => res + getRowStickyHeight(row), 0)

	cache = {
		stickyContainerHeight,
	}

	return cache
}

let payload = {
	up: {
		anchor: null,
		offset: 100,
	},
	down: {
		anchor: null,
		offset: 0,
	},
}

export const computeAutoHide = (args) => {
	let {
		currentScrollY,
		stickyContainer,
		containerInitialHeight,
		startPosition,
		isSticky,
	} = args

	let direction = currentScrollY < args.prevScrollY ? 'up' : 'down'

	if (isSticky && currentScrollY - args.prevScrollY === 0) {
		maybeSetStickyHeightAnimated(() => {
			return '0px'
		})
	}

	if (direction === 'up') {
		processUpDirection(args)
	}

	if (direction === 'down') {
		processDownDirection(args)
	}

	if (isSticky) {
		shrinkHandleLogo({ stickyContainer, startPosition })
		shrinkHandleMiddleRow({
			stickyContainer,
			containerInitialHeight,
			startPosition,
		})
	} else {
		Array.from(stickyContainer.querySelectorAll('[data-row]')).map((row) =>
			row.removeAttribute('style')
		)
		Array.from(
			stickyContainer.querySelectorAll(
				'[data-row*="middle"] .site-logo-container'
			)
		).map((el) => el.removeAttribute('style'))
	}

	renderPayload(args)
}

const processUpDirection = ({
	containerInitialHeight,
	stickyContainer,
	stickyComponents,
	isSticky,
	prevScrollY,
	startPosition,
	currentScrollY,
}) => {
	let { stickyContainerHeight } = getData({ stickyContainer })

	if (isSticky && currentScrollY - prevScrollY === 0) {
		maybeSetStickyHeightAnimated(() => {
			return '0px'
		})
	}

	if (
		!payload.up.anchor &&
		currentScrollY > containerInitialHeight * 2 + startPosition &&
		stickyContainer.dataset.sticky.indexOf('yes:') === -1
	) {
		payload.up.anchor = currentScrollY
		stickyContainer.dataset.sticky = ['yes', ...stickyComponents].join(':')

		setTransparencyFor(stickyContainer, 'no')
		document.body.removeAttribute('style')
	}

	if (
		!payload.up.anchor &&
		payload.down.anchor &&
		payload.down.offset === stickyContainerHeight
	) {
		payload.up.anchor = currentScrollY
		payload.down.anchor = null
	}

	if (!isSticky) {
		payload.up.anchor = null

		stickyContainer.dataset.sticky = [...stickyComponents].join(':')

		setTransparencyFor(stickyContainer, 'yes')

		maybeSetStickyHeightAnimated(() => {
			return '0px'
		})
	}
}

const processDownDirection = ({ currentScrollY, stickyContainer }) => {
	let { stickyContainerHeight } = getData({ stickyContainer })

	if (!payload.down.anchor && payload.up.anchor && payload.up.offset === 0) {
		payload.up.anchor = null
		payload.down.anchor = currentScrollY
	}

	if (
		!payload.down.anchor &&
		payload.up.anchor &&
		payload.up.offset === stickyContainerHeight
	) {
		payload.up.anchor = null
		payload.down.anchor = currentScrollY - stickyContainerHeight
	}
}

const renderPayload = ({ currentScrollY, stickyContainer }) => {
	let offset = null

	let { stickyContainerHeight } = getData({ stickyContainer })

	if (payload.down.anchor) {
		payload.down.offset = clamp(
			0,
			stickyContainerHeight,
			currentScrollY - payload.down.anchor
		)

		offset = payload.down.offset
	}

	if (!payload.down.anchor && payload.up.anchor) {
		payload.up.offset = clamp(
			0,
			stickyContainerHeight,
			stickyContainerHeight - (payload.up.anchor - currentScrollY)
		)

		offset = payload.up.offset
	}

	if (offset !== null) {
		stickyContainer.style.transform = `translate3d(0px, ${
			Math.floor(offset) * -1
		}px, 0px)`

		maybeSetStickyHeightAnimated(() => {
			return `${stickyContainerHeight - offset}px`
		})
	}
}
